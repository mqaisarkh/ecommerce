<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function product_grid(Request $request, $slug = null)
    {
        $categories = Category::withCount('products')->get();

        $productsQuery = Product::with('category')->latest();

        if ($slug) {
            $category = Category::where('slug', $slug)->firstOrFail();
            $productsQuery->where('category_id', $category->id);
        }

        if ($request->filled('q')) {
            $productsQuery->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%')
                    ->orWhereHas('category', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->q . '%');
                    });
            });
        }

        $products = $productsQuery->paginate(9)->withQueryString();

        return view('frontend.product.product-grid', compact('products', 'categories'));
    }


    public function show($slug)
    {
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();

        return view('frontend.product.product-detail', compact('product'));
    }

    public function cart()
    {
        return view('frontend.product.cart');
    }

    public function checkout()
    {
        return view('frontend.product.checkout');
    }
}
