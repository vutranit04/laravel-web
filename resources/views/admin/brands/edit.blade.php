@extends('admin.layouts.admin')
@section('title','Sửa thương hiệu')
@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Sửa thương hiệu
    </h1>
            <x-admin.alert/>
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
                            @error('brandname')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <input type="text"
                           name="slug" value="{{ old('slug',$brand->slug) }}"
                           class="form-control">
                            @error('slug')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status', 1) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">Hiển thị</label>

                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status', 1) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                        @error('status')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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