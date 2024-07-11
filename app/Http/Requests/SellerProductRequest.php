<?php

namespace App\Http\Requests;

use App\Rules\ValidatePrice;
use Illuminate\Foundation\Http\FormRequest;

class SellerProductRequest extends FormRequest
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
          'name' => 'required|unique:products,name',
            'summary' => 'required|min:1',
            'product_image' => 'required|mimes:png,jpg,jpeg|max:1024',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'price' => ['required', new ValidatePrice],
            'compare_price' => ['nullable', new ValidatePrice],
        ];
    }
    public function messages(): array
    {
        return [
           'name.required' => 'Enter product name',
            'name.unique' => 'This product name is already taken.',
            'summary.required' => 'Write summary for this product',
            'product_image.required' => 'Choose product image',
            'category.required' => 'Select product category',
            'subcategory.required' => 'Select product sub category',
            'price.required' => 'Enter product price'
        ];
    }
}
