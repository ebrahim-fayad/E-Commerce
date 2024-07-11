<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerShopRequest extends FormRequest
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
            // 'shop_name' => ['required', "unique:shops,shop_name,{$this->id}"],
            // 'shop_phone' => 'required|numeric',
            // 'shop_address' => 'required',
            // 'shop_description' => 'required',
            // 'shop_logo' => 'nullable|mimes:jpeg,png,jpg'
        ];
    }
}
