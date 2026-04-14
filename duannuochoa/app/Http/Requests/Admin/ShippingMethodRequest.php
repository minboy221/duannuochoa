<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên phương thức vận chuyển.',
            'name.string' => 'Tên phương thức vận chuyển phải là chuỗi ký tự.',
            'name.max' => 'Tên phương thức vận chuyển không được vượt quá 255 ký tự.',
            'fee.required' => 'Vui lòng nhập phí vận chuyển.',
            'fee.numeric' => 'Phí vận chuyển phải là một số.',
            'fee.min' => 'Phí vận chuyển không được nhỏ hơn 0.',
        ];
    }
}
