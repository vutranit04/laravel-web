{{-- //Thừa kế layout/view/admin.blade.php
//Resource/view/admin/layouts/admin.blade.php --}}
@extends('admin.layouts.admin')
{{-- //gán nội dung cho vùng section title --}}
@section('title', 'Loại thương hiệu')
@section('content')
<h2 class="mb-3">DANH SÁCH CÁC THƯƠNG HIỆU</h2>
{{-- file resources/views/admin/brands/index.blade.php --}}
<a href="{{ route('admin.categories.create') }}" class="btn btn-success
mb-3">
+ Thêm mới
</a>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>Mã thương hiệu</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->brandname }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    @if ($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
        @endforeach
    </tbody>
</table>
@endsection