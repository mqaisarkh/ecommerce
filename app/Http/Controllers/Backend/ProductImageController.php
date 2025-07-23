<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function index(int $productId)
    {
        $product = Product::with('images')->findOrFail($productId);
        return view('backend.product-image.index', compact('product'));
    }

    public function store(Request $request, int $productId)
    {
        // Validate that images are present and are files
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',  // validate each file
        ]);

        $product = Product::findOrFail($productId);

        foreach ($request->file('images') as $imageFile) {
            // Store the image in 'public/products' folder (adjust as needed)
            $path = $imageFile->store('products', 'public');

            // Save image record to DB
            ProductImage::create([
                'product_id' => $product->id,
                'product_images' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    public function destroy(int $imageId)
    {
        $image = ProductImage::findOrFail($imageId);

        // Delete image file from storage
        Storage::disk('public')->delete($image->product_images); // or ->path if renamed

        // Delete the DB record
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
