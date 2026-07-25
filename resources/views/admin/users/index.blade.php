@extends('admin.layouts.admin')

@section('title', 'Danh sách người dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>
<div class="mb-3">
    <a href="{{ route('admin.users.create') }}" class="btn btn-success me-2">
        + Thêm mới
    </a>
    <a href="{{ route('admin.users.trash') }}" class="btn btn-danger">
        <i class="bi bi-trash"></i> Thùng rác
    </a>
</div>

<x-admin.alert />
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
                    @elseif($item->gender == 2)
                        Nữ
                    @else
                        Không cung cấp
                    @endif
                </td>

                <td>{{ $item->birthday }}</td>

                <td>
                    @if($item->role == 1)
                        <span class="badge bg-danger">Quản lý</span>
                    @elseif($item->role == 2)
                        <span class="badge bg-primary">Nhân viên</span>
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