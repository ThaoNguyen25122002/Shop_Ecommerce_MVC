<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'name' => 'required',
            'price' => 'required|integer',
            'id_category' => 'required',
            'id_brand' => 'required',
            'option' => 'required',
            'discount_percentage' => 'nullable|max: 100',
            'option' => 'required',
            'company' => 'required',
            'images' => 'array|max:3', 
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024', // Mỗi file phải là image và không quá 1MB
            'detail' => 'required',
        ];
    }
}
