<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $rules = [
            'productName' => 'required|string',
            'descript' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',

        ];

        if (!$this->route('id')) {
            $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg|max:1024';
            // $rules['gallery'] = 'required|image|mimes:jpeg,png,jpg';
        } else {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg|max:1024';
            $rules['status'] = ['required', Rule::in(array_column(Status::cases(), 'value'))];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'productName.required' => 'Tên sản phẩm là bắt buộc.',
            'descript.required' => 'Mô tả sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.min' => 'Giá sản phẩm không được âm.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'thumbnail.required' => 'Ảnh sản phẩm là bắt buộc khi thêm mới.',
            'thumbnail.image' => 'Ảnh sản phẩm phải là một hình ảnh.',
            'thumbnail.max' => 'Ảnh sản phẩm không được vượt quá 1MB.',
            'thumbnail.mimes' => 'Các file phải có định dạng jpeg, png hoặc jpg.',
            'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'quantity.min' => 'Số lượng sản phẩm không được âm.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'status.required' => 'Trạng thái sản phẩm là bắt buộc khi cập nhật.',
            'gallery.image' => 'Các file phải là hình ảnh.',
            'gallery.mimes' => 'Các file phải có định dạng jpeg, png hoặc jpg.',
            'gallery.max' => 'Ảnh trong bộ sưu tập không được vượt quá 1MB.',
        ];
    }
}
