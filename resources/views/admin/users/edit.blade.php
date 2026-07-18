{{-- resources/views/admin/users/create.blade.php --}}
@extends('admin.layouts.admin')
@section('title','Sửa người dùng')

@section('content')
    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Sửa người dùng</h3>
            @if(session ('error'))
        <div class=" alert alert-danger">
            {{ session ('error') }}
            @endif
        </div>
        <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
               
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Họ và tên (Fullname)</label>
                        <input type="text" name="fullname" class="form-control" required value="{{ old('fullname',$user->fullname) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập (Username)</label>
                        <input type="text" name="username" class="form-control" required value="{{ old('username',$user->username) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email',$user->email) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu (ĐỂ TRỐNG NẾU KHÔNG ĐỐI)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Giới tính</label>
                        <select name="gender" class="form-select">
                            <option value="">-- Chọn giới tính --</option>
                            <option value="0" {{ old('gender',$user->gender) == 0 ? 'selected' : '' }}>Nam</option>
                            <option value="1" {{ old('gender',$user->gender) == 1 ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" value="{{ old('birthday',$user->birthday) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone'  ,$user->phone) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea name="address" rows="3" class="form-control">{{ old('address',$user->address) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vai trò</label>
                        <select name="role" class="form-select">
                            <option value="0" {{ old('role',$user->role) == 'user' ? 'selected' : '' }}>Khách hàng</option>
                            <option value="1" {{ old('role',$user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $user->status) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hoạt động
                        </label>
                        
                        <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status',$user->status) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Khóa
                        </label>
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