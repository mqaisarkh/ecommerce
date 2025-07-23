<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        return view('frontend.cart.index', compact('cart', 'totalAmount'));
    }


    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);


        if ($product->quantity < 1) {
            return back()->with('error', 'Product is out of stock.');
        }


        $cart = session()->get('cart', []);


        if (isset($cart[$product->id])) {

            if ($product->quantity <= $cart[$product->id]['quantity']) {
                return back()->with('error', 'No more stock available for this product.');
            }


            $cart[$product->id]['quantity']++;
        } else {

            $cart[$product->id] = [
                'title'    => $product->title,
                'price'    => $product->price,
                'image'    => $product->main_image,
                'quantity' => 1,
            ];

        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }
    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('id');
        $quantity = (int) $request->input('quantity');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'updated_quantity' => $quantity
        ]);
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }
}
