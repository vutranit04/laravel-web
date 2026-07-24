{{-- resources/views/admin/users/create.blade.php --}}
@extends('admin.layouts.admin')

@section('title', 'Thêm Người Dùng')

@section('content')
    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Thêm người dùng</h3>
        <x-admin.alert />
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Họ và tên (Fullname)</label>
                        <input type="text" name="fullname" class="form-control" required value="{{ old('fullname') }}">
                               @error('fullname')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập (Username)</label>
                        <input type="text" name="username" class="form-control" required value="{{ old('username') }}">
                               @error('username')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                               @error('email')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control"  value="{{ old('password') }}"required>
                               @error('password')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới tính</label>
                        <select name="gender" class="form-select">
                            <option value="">-- Chọn giới tính --</option>
                            <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Nam</option>
                            <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>Nữ</option>
                            <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Không cung cấp</option>
                        </select>
                               @error('gender')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
                               @error('birthday')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                             @error('phone')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea name="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                               @error('address')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                           @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vai trò</label>
                        <select name="role" class="form-select">
                            <option value="">-- Chọn vai trò --</option>
                            <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Quản lý</option>
                            <option value="2" {{ old('role', 2) == 2 ? 'selected' : '' }}>Nhân viên</option>
                        </select>
                        @error('role')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status', 1) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hoạt động
                        </label>

                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Khóa
                        </label>

                            @error('status')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    Lưu người dùng
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Quay lại
                </a>
            </div>

        </form>
    </div>
@endsection
