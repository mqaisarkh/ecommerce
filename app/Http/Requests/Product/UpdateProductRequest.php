<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
            'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The product title is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'description.required' => 'A product description is required.',
            'quantity.required' => 'Please enter the quantity.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity cannot be negative.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'original_price.numeric' => 'Original price must be a valid number.',
            'discount_percentage.between' => 'Discount must be between 0 and 100.',
            'is_on_sale.boolean' => 'Sale value must be true or false.',
            'main_image.image' => 'The uploaded file must be an image.',
            'main_image.mimes' => 'Allowed image formats are: jpg, jpeg, png, gif.',
            'product_images.*.image' => 'Each product image must be a valid image.',
            'product_images.*.mimes' => 'Allowed image formats are: jpg, jpeg, png, gif.',
        ];
    }
}
