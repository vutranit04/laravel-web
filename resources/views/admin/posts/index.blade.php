@extends('admin.layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>
<div class="mb-3">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success me-2">
        + Thêm mới
    </a>
    <a href="{{ route('admin.posts.trash') }}" class="btn btn-danger">
        <i class="bi bi-trash"></i> Thùng rác
    </a>
</div>

<x-admin.alert />
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Slug</th>
            <th>Nội dung</th>
            <th>Hình ảnh</th>
            <th>Người đăng</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>

                <td>{{ $item->title }}</td>

                <td>{{ $item->slug }}</td>

                <td>
                    {{$item->content }}
                </td>
                
                <td><img src="{{ asset('images/df.png') }}" alt="" width="40px"></td>

        
                 <td>
                    {{ $item->user->fullname }}
                </td>

                <td>
                    @if ($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>

                <td>
                    {{ $item->created_at }}
                </td>
                     <td>
                    <a href="{{ route('admin.posts.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ route('admin.posts.destroy', $item->id) }}"
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