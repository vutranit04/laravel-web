@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Thêm loại sản phẩm
    </h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Tên loại sản phẩm</label>
                    <input type="text"
                           name="catename"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text"
                           name="slug"
                           class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    + Lưu dữ liệu
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-secondary">
                    Quay lại
                </a>

            </form>

        </div>
    </div>

</div>
@endsection