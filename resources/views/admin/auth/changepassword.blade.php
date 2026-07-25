@extends('admin.layouts.admin')

@section('title', 'Đổi mật khẩu')

@section('content')
    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Đổi mật khẩu tài khoản</h3>

        {{-- Component hiển thị thông báo lỗi / thành công --}}
        <x-admin.alert />

        {{-- Khối thông tin người dùng đang đăng nhập --}}
        <div class="card mb-4 bg-light border-0">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="bi bi-person-circle me-2"></i>Thông tin tài khoản</h5>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <p class="mb-1 text-muted">Họ và tên:</p>
                        <strong>{{ Auth::user()->fullname }}</strong>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 text-muted">Tên đăng nhập:</p>
                        <strong>{{ Auth::user()->username }}</strong>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 text-muted">Email:</p>
                        <strong>{{ Auth::user()->email }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form đổi mật khẩu --}}
        <form action="{{ route('admin.changepassword.post') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" id="current_password" 
                            class="form-control @error('current_password') is-invalid @enderror" 
                            placeholder="Nhập mật khẩu hiện tại" required>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-bold">Mật khẩu mới <span class="text-danger">*</span></label>
                        <input type="password" name="new_password" id="new_password" 
                            class="form-control @error('new_password') is-invalid @enderror" 
                            placeholder="Nhập mật khẩu mới (tối thiểu 4 ký tự)" required>
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-bold">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                            class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                            placeholder="Nhập lại mật khẩu mới" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-circle me-1"></i>Đổi mật khẩu
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Quay lại Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
