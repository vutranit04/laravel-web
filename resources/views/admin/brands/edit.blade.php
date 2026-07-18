@extends('admin.layouts.admin')
@section('title','Sửa thương hiệu')
@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Sửa thương hiệu
    </h1>
  @if(session ('error'))
        <div class=" alert alert-danger">
            {{ session ('error') }}
        </div>
        @endif
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.brands.update',$brand->id) }}" method="POST">
                @csrf
            @method('PUT')
                <div class="mb-3">
                    <label>Tên thương hiệu</label>
                    <input type="text"
                           name="brandname" value="{{ old('brandname',$brand->brandname) }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text"
                           name="slug" value="{{ old('slug',$brand->slug) }}"
                           class="form-control">
                </div>
                    <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                      <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Ẩn</option>
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