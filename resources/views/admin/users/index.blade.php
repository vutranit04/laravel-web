@extends('admin.layouts.admin')

@section('title', 'Danh sách người dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>
<a href="{{ route('admin.users.create') }}" class="btn btn-success
mb-3">
+ Thêm mới
</a>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>    
            <th>ID</th>
            <th>Họ tên</th>
            <th>Hình ảnh</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->fullname }}</td>
                <td><img src="{{ asset('images/avt.webp') }}" alt="" width="40px"></td>

                <td>{{ $item->username }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->address }}</td>
                <td>
                    @if($item->gender == 1)
                        Nam
                    @elseif($item->gender == 0)
                        Nữ
                    @else
                        Khác
                    @endif
                </td>

                <td>{{ $item->birthday }}</td>

                <td>
                    @if($item->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                </td>

                <td>
                    @if ($item->status == 1)
                        <span class="badge bg-success">Hoạt động</span>
                    @else
                        <span class="badge bg-secondary">Khóa</span>
                    @endif
                </td>
                <td>
                      <a href="{{ route('admin.users.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ route('admin.users.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list -> links()  }}

</div>
@endsection