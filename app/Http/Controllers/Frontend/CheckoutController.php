<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    /**
     * Store shipping address temporarily in session.
     */
    public function storeShipping(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
        ]);

        session()->put('shipping_address', $request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'city',
            'country',
            'state',
        ]));

        return redirect()->back()->with('success', 'Shipping details saved!');
    }

    /**
     * Initiate Stripe Checkout and create the order.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = session()->get('totalPrice', 0);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // Stripe line items
        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['title'],
                    ],
                    'unit_amount' => intval($item['price'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * Handle success after Stripe payment.
     */
    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            abort(404, 'Missing session_id');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get session cart & shipping
        $cart = session()->get('cart', []);
        $total = session()->get('totalPrice', 0);
        $shippingData = session('shipping_address');

        if (empty($cart) || empty($shippingData)) {
            return redirect()->route('home')->with('error', 'Session expired or incomplete.');
        }

        // Create order AFTER payment confirmation
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'payment_intent' => $sessionId,
            'order_status' => OrderStatus::Processing,
            'payment_status' => PaymentStatus::Paid,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'title' => $item['title'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image'],
            ]);
        }

        // Save shipping
        ShippingAddress::create(array_merge($shippingData, [
            'order_id' => $order->id,
        ]));

        // Clean up session
        session()->forget('shipping_address');
        session()->forget('cart');
        session()->forget('totalPrice');

        return redirect()->route('home')->with('success', 'Order completed successfully.');
    }
}
