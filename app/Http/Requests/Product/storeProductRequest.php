<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class storeProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'available_quantity' => 'nullable|integer|min:0|lte:quantity',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'discount_percentage' => 'nullable|integer|between:0,100',
            'is_on_sale' => 'nullable|boolean',
            'features' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ];
    }



    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a product title.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'description.required' => 'Description is required.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity cannot be negative.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'original_price.numeric' => 'Original price must be a valid number.',
            'discount_percentage.between' => 'Discount must be between 0 and 100.',
            'is_on_sale.boolean' => 'Sale value must be true or false.',
            'main_image.image' => 'The uploaded file must be a valid image.',
            'main_image.mimes' => 'Allowed image formats are: jpg, jpeg, png, gif.',
            'product_images.*.image' => 'Each product image must be a valid image.',
            'product_images.*.mimes' => 'Allowed image formats for product images are: jpg, jpeg, png, gif.',
        ];
    }
}
