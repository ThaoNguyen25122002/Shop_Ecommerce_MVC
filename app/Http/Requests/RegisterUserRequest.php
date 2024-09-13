<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn cần phải nhập vào tên.',
            'email.required' => 'Bạn cần phải nhập vào địa chỉ email.',
            'email.email' => 'Địa chỉ email của bạn không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'password.required' => 'Bạn cần phải nhập vào mật khẩu.',
            'password.min' => 'Mật khẩu của bạn phải chứa ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ];
    }
}
