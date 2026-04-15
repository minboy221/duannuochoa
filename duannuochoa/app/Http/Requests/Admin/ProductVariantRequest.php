<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'volume_id' => 'required|integer',
            'color' => 'nullable|string',
            'color_code' => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'stock_quantity' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'volume_id.required' => 'Vui lòng chọn dung tích.',
            'volume_id.integer' => 'Dung tích không hợp lệ.',
            'price.required' => 'Vui lòng nhập giá cho biến thể.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
            'stock_quantity.required' => 'Vui lòng nhập số lượng tồn kho.',
            'stock_quantity.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock_quantity.min' => 'Số lượng tồn kho không được nhỏ hơn 0.',
            'color_code.regex' => 'Mã màu không hợp lệ.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ (jpeg, png, jpg, gif, webp).',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        ];
    }
}
