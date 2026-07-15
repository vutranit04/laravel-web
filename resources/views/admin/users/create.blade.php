    @extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Thêm thành viên mới (User)
    </h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text"
                           name="fullname"
                           class="form-control" placeholder="Nhập họ và tên..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ Email</label>
                    <input type="email"
                           name="email"
                           class="form-control" placeholder="Nhập email..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password"
                           name="password"
                           class="form-control" placeholder="Nhập mật khẩu..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện (Avatar)</label>
                    <input type="file" 
                           name="image" 
                           class="form-control" 
                           accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Vai trò / Phân quyền (Role)</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Chọn vai trò --</option>
                        <option value="admin">Quản trị viên (Admin)</option>
                        <option value="editor">Biên tập viên (Editor)</option>
                        <option value="user">Thành viên (User)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái tài khoản</label>
                    <select name="status" class="form-select">
                        <option value="1" selected>Kích hoạt</option>
                        <option value="0">Khóa tài khoản</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        + Lưu thành viên
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-secondary">
                        Quay lại
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection