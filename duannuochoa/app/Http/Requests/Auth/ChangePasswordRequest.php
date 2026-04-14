<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'confirmed' => 'Xác nhận :attribute không khớp.',
            'current_password' => ':attribute không chính xác.',
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => 'Mật khẩu hiện tại',
            'new_password' => 'Mật khẩu mới',
        ];
    }
}
