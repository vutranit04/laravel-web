@extends('admin.layouts.admin')
@section('title', 'Sửa danh mục')
@section('content')

<div class="container-fluid">

    <h1 class="mb-4 text-uppercase">
        Sửa danh mục
    </h1>
  @if(session ('error'))
        <div class=" alert alert-danger">
            {{ session ('error') }}
        </div>
        @endif
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tên danh mục</label>
                    <input type="text"
                           name="catename"
                           value="{{ old('catename', $category->catename) }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text"
                           name="slug"
                           value="{{ old('slug',$category->slug) }}"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả danh mục</label>
                    <textarea name="description" 
                              class="form-control" 
                              rows="3" 
                              placeholder="Nhập mô tả ngắn về danh mục...">{{ old('description',$category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh đại diện</label>
                    <input type="file" 
                           name="image" 
                           class="form-control" 
                           accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        + Lưu danh mục
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
                       class="btn btn-secondary">
                        Quay lại
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection