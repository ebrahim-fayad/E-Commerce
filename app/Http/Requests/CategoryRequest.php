<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
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
        $rules = [
            'category_name' => ['bail', 'required', 'string', 'max:30', 'unique:categories,category_name,' . $this->id],
        ];

        if ($this->isMethod('post')) {
            $rules['category_image'] = ['bail', 'required', 'image'];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['category_image'] = ['bail', 'sometimes', 'image'];
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            'category_name.required' => 'Category Name is required',
            'category_name.string' => 'Category Name must be a string',
            'category_name.max' => 'Category Name may not be greater than 30 characters',
            'category_name.unique' => 'Category Name has already been taken',
            'category_image.required' => 'Category Image is required',
            'category_image.image' => 'Category Image must be an image file',
        ];
    }
}
