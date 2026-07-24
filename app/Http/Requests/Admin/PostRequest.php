<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // lấy model Post từ tham số post từ URL hiện tại (Resource Route)
        $post = $this->route('post');
        return [
            'title' => [
                'required',
                'min:3',
                'max:200',
                Rule::unique('posts', 'title')->ignore($post),
            ],
            'slug' => [
                'required',
                'min:3',
                'max:250',
                Rule::unique('posts', 'slug')->ignore($post),
                'regex:/^[a-z0-9-]+$/',
            ],
            'content' => [
                'required',
                'string',
            ],
            'image' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'status' => 'required|in:0,1',
            'userid' => [
                'required',
                'exists:users,id',
            ],
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
            'image.image' => ':attribute phải là tệp hình ảnh.',
            'image.mimes' => ':attribute chỉ chấp nhận định dạng jpg, jpeg, png, webp.',
            'image.max' => ':attribute không được vượt quá 2MB.',
            'status.in' => ':attribute không hợp lệ.',
            'userid.exists' => ':attribute không tồn tại.',
        ];
    }
     //Khai báo hiển thị
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề bài viết',
            'slug' => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'image' => 'Hình ảnh',
            'status' => 'Trạng thái',
            'userid' => 'Người đăng',
        ];
    }
}
