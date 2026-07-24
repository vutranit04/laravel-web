<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    //Xác định người dùng có quyền gửi Request hay không
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // lấy model Brand từ tham số brand từ URL hiện tại (Resource Route)
        $brand = $this->route('brand');
        return [
            'brandname' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('brands', 'brandname')->ignore($brand),
            ],
            'slug' => [
                'required',
                'min:3',
                'max:150',
                Rule::unique('brands', 'slug')->ignore($brand),
                'regex:/^[a-z0-9-]+$/',
            ],
            'img' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200,'
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => 'required|in:0,1',
        ];
    }
    //Khai báo nội dung thông báo lỗi
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'img.image' => ':attribute phải là hình ảnh.',
            'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
            'img.max' => ':attribute không được vượt quá 200 KB.',
        ];
    }
    //Khai báo hiển thị
    public function attributes(): array
    {
        return [
            'brandname' => 'Tên thương hiệu',
            'slug' => 'Đường dẫn (Slug)',
            'img' => 'Hình ảnh',
            'status' => 'Trạng thái',
            'description' => 'Mô tả'
        ];
    }
}
