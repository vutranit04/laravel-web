@extends('admin.layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>
<a href="{{ route('admin.categories.create') }}" class="btn btn-success
mb-3">
+ Thêm mới
</a>
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
                    {{ $item->fullname }}
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
            </tr>
        @endforeach
    </tbody>
</table>
@endsection