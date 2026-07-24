@extends('admin.layouts.admin')
@section('title', 'Sửa thương hiệu')
@section('content')

    <div class="container-fluid">

        <h1 class="mb-4 text-uppercase">
            Sửa thương hiệu
        </h1>
        <x-admin.alert />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" name="brandname" value="{{ old('brandname', $brand->brandname) }}"
                                    class="form-control">
                                @error('brandname')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug', $brand->slug) }}"
                                    class="form-control">
                                @error('slug')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 img-group">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" name="img" class="form-control img-input">
                                <div class="img-preview mt-2">
                                    @if ($brand->image)
                                        <img src="{{ asset('storage/brands/' . $brand->image) }}"
                                            alt="{{ $brand->brandname }}" width="150" class="img-thumbnail">
                                    @endif
                                </div>
                                @error('img')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label d-block">Trạng thái</label>
                                <input type="radio" class="btn-check" name="status" id="active" value="1"
                                    {{ old('status', $brand->status) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="active">Hiển thị</label>

                                <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                                    {{ old('status', $brand->status) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                                @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Lưu
                    </button>

                    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                        Quay lại
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection