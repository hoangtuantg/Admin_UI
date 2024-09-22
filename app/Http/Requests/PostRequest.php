<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'thumbnail.required' => 'Ảnh đại diện bài viết là bắt buộc.',
            'thumbnail.image' => 'Ảnh đại diện bài viết phải là một hình ảnh.',
            'thumbnail.max' => 'Ảnh đại diện không được vượt quá 1MB.',
        ];
    }
}
