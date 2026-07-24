<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    //Khai báo các quy tắc Validation dùng chung cho chức năng thêm mới và cập nhật sản phẩm:
    public function rules(): array
    {
        // lấy model Product từ tham số product từ URL hiện tại (Resource Route)
        $product = $this->route('product');
        return [
            'productname' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('products', 'productname')->ignore($product),
            ],
            'slug' => [
                'required',
                'min:3',
                'max:150',
                Rule::unique('products', 'slug')->ignore($product),
                'regex:/^[a-z0-9-]+$/',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'img' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
            ],
            // mảng
            'imgs' => [
                'nullable',
                'array',
            ],
            // từng phần tử trong file
            'imgs.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
            ],
            'pricediscount' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price', //nho hon hoac bang
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => 'required|in:0,1',
            'cateid' => [
                'required',
                'exists:categories,cateid',

            ],
            'brandid' => [
                'required',
                'exists:brands,id',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'numeric' => ':attribute phải là số.',
            'price.min' => ':attribute phải lớn hơn hoặc bằng 0.',
            'pricediscount.lte' => ':attribute không được lớn hơn giá gốc.',
            'image.image' => ':attribute phải là tệp hình ảnh.',
            'image.mimes' => ':attribute chỉ chấp nhận định dạng jpg, jpeg, png, webp.',
            'image.max' => ':attribute không được vượt quá 2MB.',
            'status.in' => ':attribute không hợp lệ.',
            'cateid.exists' => ':attribute không tồn tại.',
            'brandid.exists' => ':attribute không tồn tại.',
            'img' => ':attribute phải là hình ảnh.',
            'mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'img.max' => ':attribute không được vượt quá 200 KB.',
            'imgs.*.max' => ':attribute không được vượt quá 200 KB.',
        ];
    }
    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn (Slug)',
            'price' => 'Giá gốc',
            'pricediscount' => 'Giá khuyến mãi',
            'image' => 'Hình ảnh',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'cateid' => 'Danh mục',
            'brandid' => 'Thương hiệu',
            'img' => 'Hình ảnh',
        ];
    }
}
