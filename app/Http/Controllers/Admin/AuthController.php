<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        // Kiểm tra đã lưu đăng nhập chưa thì chuyển đến Dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        // validate - kiểm tra dữ liệu đầu vào
        // bổ sung thêm một số ràng buộc khác - nếu có
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
            ]
        );
        // first(): lấy ra record đầu tiên khi truy vấn dữ liệu
        $user = User::where('username', $request->username)->first();
        // Nếu không tìm thấy người dùng trong bảng users
        if (!$user) {
            return back()
                ->with('error', 'Username không tồn tại')
                ->withInput();
        }
        // Nếu tìm thấy người dùng thì kiểm tra mật khẩu
        // do mật khẩu dùng Hash::make() để mã hóa, nên cần so sánh phải dùng với hàm Hash::check()
        $check = Hash::check($request->password, $user->password); // true hoặc false
        // trường hợp mật khẩu không khớp
        if (!$check) {
            // điều hướng về trước (login) với session flash 'message'
            return back()->with('error', 'Mật khẩu không đúng')->withInput();
        }
        // Nếu biến $remember có giá trị true (nếu người dùng chọn nhớ tài khoản)
        $remember = $request->has('remember') ? true : false;
        Auth::login($user, $remember);
        // sử dụng intended để điều hướng về URL mà người dùng muốn truy cập
        // nếu không có thì điều hướng về dasboard (route name dashboard được khai báo trong web.php)
        return redirect()->intended(route('admin.dashboard'));
    }
    // Đăng xuất
    public function logout(Request $request)
    {
        // Đăng xuất user
        Auth::logout();
        // Xóa session hiện tại
        $request->session()->invalidate();
        // Tạo lại CSRF token mới
        $request->session()->regenerateToken();


        // Redirect về trang login
        return redirect()->route('admin.login');
    }
    // Hiển thị trang Quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgotpassword');
    }

    // Xử lý Quên mật khẩu & Gửi mail
    public function postForgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email này chưa được đăng ký trong hệ thống!')->withInput();
        }

        // Tạo token ngẫu nhiên
        $token = Str::random(60);

        // Lưu hoặc cập nhật token vào bảng password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // Gửi email khôi phục
        try {
            Mail::send('emails.reset_password', compact('user', 'token'), function ($message) use ($user) {
                $message->to($user->email, $user->fullname)
                    ->subject('Khôi phục mật khẩu tài khoản Admin');
            });

            return back()->with('success', 'Đã gửi liên kết khôi phục mật khẩu đến email của bạn. Vui lòng kiểm tra hòm thư!');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email. Lỗi: ' . $e->getMessage());
        }
    }

    // Hiển thị trang Đặt lại mật khẩu từ link trong Email
    public function resetPassword($token)
    {
        return view('admin.auth.resetpassword', compact('token'));
    }

    // Xử lý Đặt lại mật khẩu mới
    public function postResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ], [
            'token.required' => 'Mã xác nhận không hợp lệ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp.',
        ]);

        // Kiểm tra token có hợp lệ không
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Liên kết khôi phục không hợp lệ hoặc đã hết hạn!');
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Tài khoản không tồn tại!');
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->save();

        // Xóa token đã sử dụng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('admin.login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập bằng mật khẩu mới.');
    }

    // Hiển thị trang Đổi mật khẩu
    public function changePassword()
    {
        $user = Auth::user();
        return view('admin.auth.changepassword', compact('user'));
    }

    // Xử lý Đổi mật khẩu
    public function postChangePassword(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:4|confirmed',
            'new_password_confirmation' => 'required',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
            'new_password.confirmed' => 'Mật khẩu mới và mật khẩu xác nhận không trùng khớp.',
            'new_password_confirmation.required' => 'Vui lòng nhập lại mật khẩu mới.',
        ]);

        $user = Auth::user();

        // 2. Kiểm tra mật khẩu cũ có chính xác hay không
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác!');
        }

        // 3. Mã hóa mật khẩu mới bằng Hash::make() và cập nhật vào CSDL
        /** @var \App\Models\User $user */
        $user->password = Hash::make($request->new_password);
        $user->save();

        // 4. Hiển thị thông báo đổi mật khẩu thành công
        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
