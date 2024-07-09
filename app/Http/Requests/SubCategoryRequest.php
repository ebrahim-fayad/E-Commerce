<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            // 'subcategory_name' => 'required|min:5|unique:sub_categories,subcategory_name',
            'subcategory_name' => 'required|min:5|unique:sub_categories,subcategory_name,'.$this->id,
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required' => ':Attribute is required',
            'category_id.exists' => ':Attribute is not exists in categories table',
            'subcategory_name.required' => ':Attribute is required',
            'subcategory_name.min' => ':Attribute must contains atleast 5 characters',
            'subcategory_name.unique' => 'This :attribute is already exists'
        ];
    }
}
