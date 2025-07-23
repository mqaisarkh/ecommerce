<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();

        return view('frontend.index', compact('products'));

    }
    public function contact() {
        return view('frontend.contact');
    }

}

