<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\storeProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index()
    {

        $products = Product::with('category', 'images')->latest()->paginate(10);


        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();


        return view('backend.products.create', compact('categories'));
    }

    public function store(storeProductRequest $request)
    {
        $validatedData = $request->validated();

        // Remove product_images from validated data before creating product
        unset($validatedData['product_images']);

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $path = $image->store('products/images', 'public');
            $validatedData['main_image'] = $path;
        }

        $product = Product::create($validatedData);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $imageFile) {
                $path = $imageFile->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'product_images' => $path,
                ]);
            }
        }

        return redirect()->route('products.list')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {

        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();


        unset($validatedData['product_images']);

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $path = $image->store('products/images', 'public');
            $validatedData['main_image'] = $path;
        }

        $product->update($validatedData);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $imageFile) {
                $path = $imageFile->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'product_images' => $path,
                ]);
            }
        }

        return redirect()->route('products.list')->with('success', 'Product updated successfully.');
    }
    public function destroyImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete the image file from storage
        if (Storage::disk('public')->exists($image->product_images)) {
            Storage::disk('public')->delete($image->product_images);
        }

        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }




    public function delete(Product $product)
    {

        if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
            Storage::disk('public')->delete($product->main_image);
        }

        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->product_images)) {
                Storage::disk('public')->delete($image->product_images);
            }
            $image->delete();
        }

        $product->delete();
        return redirect()->route('products.list')->with('success', 'Category deleted successfully.');
    }
}
