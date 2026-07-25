@extends('admin.layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>
<div class="mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-success me-2">
        + Thêm mới
    </a>
    <a href="{{ route('admin.products.trash') }}" class="btn btn-danger">
        <i class="bi bi-trash"></i> Thùng rác
    </a>
</div>

<x-admin.alert />
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
              <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Loại</th>
            <th>Thương hiệu</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th width="120">Thao tác</th>


        </tr>
    </thead>

    <tbody>
        @forelse ($list as $item)
            <tr>
                <td>{{ $list->firstItem() + $loop->index }}</td>
                 <td>
                        @if($item->image)
                            <img src="{{ asset('storage/products/' . $item->image) }}" width="80"
                            class="img-thumbnail">
                        @endif
                    </td>
                <td>{{ $item->productname }}</td>

                <td>{{ $item->category?->catename }}</td>
                
                <td>{{ $item->brand?->brandname }}</td>
                <td>{{ number_format($item->price,) }} đ</td>
               <td>
                    @if ($item->status)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $item->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ route('admin.products.destroy', $item->id) }}"
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

            @empty
            <tr>
                <td colspan="8" class="text-center"> Không có dữ liệu
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list -> links()  }}

</div>
@endsection