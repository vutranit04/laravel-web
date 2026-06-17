@extends('admin.layouts.admin')

@section('title', 'Danh sách người dùng')

@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>
<a href="{{ route('admin.categories.create') }}" class="btn btn-success
mb-3">
+ Thêm mới
</a>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection