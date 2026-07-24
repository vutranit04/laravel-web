{{-- //Thừa kế layout/view/admin.blade.php
//Resource/view/admin/layouts/admin.blade.php --}}
@extends('admin.layouts.admin')
{{-- //gán nội dung cho vùng section title --}}
@section('title', 'Loại thương hiệu')
@section('content')
    <h2 class="mb-3">DANH SÁCH CÁC THƯƠNG HIỆU</h2>
    {{-- file resources/views/admin/brands/index.blade.php --}}
    <a href="{{ route('admin.brands.create') }}" class="btn btn-success
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
                <th>Mã thương hiệu</th>
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
                            <img src="{{ asset('storage/brands/' . $item->image) }}" width="80"
                            class="img-thumbnail">
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
                        <a href="{{ route('admin.brands.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.brands.destroy', $item->id) }}" method="POST"
                            style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
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
        {{ $list->links() }}

    </div>
@endsection