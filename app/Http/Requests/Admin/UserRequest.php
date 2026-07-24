<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
      // lấy model User từ tham số user từ URL hiện tại (Resource Route)
        $user = $this->route('user');
        return [
            'fullname' => [
                'required',
                'min:3',
                'max:100',
            ],
            'username' => [
                'required',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/',
                Rule::unique('users', 'username')->ignore($user),
            ],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'min:6',
            
            ],
            'phone' => [
                'regex:/^[0-9]{9,11}$/',
            ],
            'address' => [
                'nullable',
                'max:255',
            ],
            'gender' => [
                'in:1,2,0',
            ],
            'birthday' => [
                'date',
                'before:today',
            ],
            'role' => [
                'required',
                'in:1,2',
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
            'email' => ':attribute không đúng định dạng.',
            'username.regex' => ':attribute chỉ được chứa chữ, số và dấu gạch dưới (_).',
            'phone.regex' => ':attribute không đúng định dạng.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'gender.in' => ':attribute không hợp lệ.',
            'birthday.date' => ':attribute không đúng định dạng ngày.',
            'birthday.before' => ':attribute phải là ngày trong quá khứ.',
            'role.in' => ':attribute không hợp lệ.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }
      //Khai báo hiển thị
    public function attributes(): array
    {
        return [
            'fullname' => 'Họ tên',
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'gender' => 'Giới tính',
            'birthday' => 'Ngày sinh',
            'role' => 'Vai trò',
            'status' => 'Trạng thái',
        ];
    }
}
