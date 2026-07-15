@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Thêm thương hiệu
    </h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Tên thương hiệu</label>
                    <input type="text"
                           name="brandname"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text"
                           name="slug"
                           class="form-control">
                </div>
                    <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" selected>Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    + Lưu dữ liệu
                </button>

                <a href="{{ route('admin.brands.index') }}"
                   class="btn btn-secondary">
                    Quay lại
                </a>

            </form>

        </div>
    </div>

</div>
@endsection