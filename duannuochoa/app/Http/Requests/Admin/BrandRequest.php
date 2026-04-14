<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhãn hàng.',
            'name.string' => 'Tên nhãn hàng phải là chuỗi ký tự.',
            'name.max' => 'Tên nhãn hàng không được vượt quá 255 ký tự.',
            'logo_url.url' => 'Đường dẫn logo phải là một URL hợp lệ.',
        ];
    }
}
