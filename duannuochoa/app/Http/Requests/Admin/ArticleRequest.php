<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required',
            'summary' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung bài viết không được để trống.',
            'summary.max' => 'Tóm tắt không được vượt quá 500 ký tự.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
            'status.required' => 'Vui lòng chọn trạng thái bài viết.',
        ];
    }
}
