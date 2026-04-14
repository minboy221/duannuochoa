<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->user_id : null;

        return [
            'role_id' => 'required|exists:roles,role_id',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId, 'user_id'),
            ],
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId, 'user_id'),
            ],
            'password' => $this->isMethod('POST') ? 'required|string|min:6' : 'nullable|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Vui lòng chọn vai trò cho người dùng.',
            'role_id.exists' => 'Vai trò đã chọn không hợp lệ.',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập này đã được sử dụng.',
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }
}
