<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size is 2MB
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'options' => 'nullable|json',
            'rating' => 'required|numeric|min:0|max:5',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|in:active,draft,archived',
            'brand_id' => 'nullable|exists:brands,id',
        ];
    }
}