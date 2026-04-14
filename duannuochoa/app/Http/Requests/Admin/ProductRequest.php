<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,category_id',
            'brand_id' => 'required|exists:brands,brand_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_featured' => 'nullable|boolean',
            'is_bestseller' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục đã chọn không hợp lệ.',
            'brand_id.required' => 'Vui lòng chọn nhãn hàng.',
            'brand_id.exists' => 'Nhãn hàng đã chọn không hợp lệ.',
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'base_price.required' => 'Vui lòng nhập giá cơ bản.',
            'base_price.numeric' => 'Giá cơ bản phải là một số.',
            'base_price.min' => 'Giá cơ bản không được nhỏ hơn 0.',
            'img.image' => 'File tải lên phải là hình ảnh.',
            'img.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'img.max' => 'Hình ảnh không được vượt quá 2MB.',
        ];
    }
}
