<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            // 'name' => 'required',
            // 'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:20',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'country' => 'nullable|string|max:20',
        ];
    }
}
