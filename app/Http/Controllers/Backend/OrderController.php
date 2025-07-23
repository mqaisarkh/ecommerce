<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items', 'shippingAddress'])->latest()->paginate(10);

        return view('backend.orders.index', compact('orders'));
    }
}
