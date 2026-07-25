@extends('admin.layouts.admin')
@section('title', 'Trash - Người dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG - ĐANG CHỜ XÓA</h2>

<x-admin.alert />

<a href="{{ route('admin.users.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left"></i> Quay lại danh sách
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Quyền</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->fullname }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                    @if ($item->role == 1)
                        <span class="badge bg-primary">Admin</span>
                    @else
                        <span class="badge bg-secondary">Khách hàng</span>
                    @endif
                </td>
                <td>
                    @if ($item->status == 1)
                        <span class="badge bg-success">Hoạt động</span>
                    @else
                        <span class="badge bg-danger">Khóa</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.users.restore', $item->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success btn-sm">Khôi phục</button>
                    </form>

                    <form action="{{ route('admin.users.forceDelete', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Xóa vĩnh viễn?')" class="btn btn-danger btn-sm">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
