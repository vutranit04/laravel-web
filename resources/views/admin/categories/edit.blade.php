@extends('admin.layouts.admin')
@section('title', 'Sửa danh mục')
@section('content')
    <div class="container-fluid">

        <h1 class="mb-4 text-uppercase">
            Sửa danh mục
        </h1>
        <x-admin.alert />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" name="catename" value="{{ old('catename', $category->catename) }}"
                                    class="form-control" required>
                                @error('catename')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                                    class="form-control" required>
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
                                    @if ($category->image)
                                        <img src="{{ asset('storage/categories/' . $category->image) }}"
                                            alt="{{ $category->catename }}" width="150" class="img-thumbnail">
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
                                    {{ old('status', $category->status) == 1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="active">Hiển thị</label>

                                <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                                    {{ old('status', $category->status) == 0 ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                                @error('status')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả danh mục</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Nhập mô tả ngắn về danh mục...">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            Lưu
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            Quay lại
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
