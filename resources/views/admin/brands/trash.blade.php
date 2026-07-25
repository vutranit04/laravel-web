@extends('admin.layouts.admin')
@section('title', 'Trash - Thương hiệu')
@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU - ĐANG CHỜ XÓA</h2>

<x-admin.alert />

<a href="{{ route('admin.brands.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left"></i> Quay lại danh sách
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/brands/' . $item->image) }}" width="80" class="img-thumbnail">
                    @endif
                </td>
                <td>{{ $item->brandname }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    @if ($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.brands.restore', $item->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success btn-sm">Khôi phục</button>
                    </form>

                    <form action="{{ route('admin.brands.forceDelete', $item->id) }}" method="POST" class="d-inline">
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
