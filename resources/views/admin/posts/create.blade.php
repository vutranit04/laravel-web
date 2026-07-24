    @extends('admin.layouts.admin')

    @section('content')

    <div class="container-fluid">

        <h1 class="mb-4 text-uppercase">
            Thêm bài viết mới
        </h1>
      <x-admin.alert/>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-control" required>
                                 @error('title')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug bài viết</label>
                        <input type="text"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="form-control" required>
                                 @error('slug')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung bài viết</label>
                        <textarea name="content" 
                                class="form-control" 
                                rows="6" 
                                placeholder="Nhập nội dung chi tiết của bài viết..." required>{{ old('content') }}
                            </textarea>
                                 @error('content')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh bài viết</label>
                        <input type="file" 
                            name="image" 
                            class="form-control" 
                            accept="image/*">
                                 @error('image')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn tác giả (User)</label>
                        <select name="userid" class="form-select" required>
                            <option value="">-- Chọn người viết bài --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" >{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                             @error('userid')
                        <span class="text-danger">
                            {{ $message }}

                        </span>
                        @enderror
                    </div>

                   <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" 
                        value="1" {{ old('status', 1) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success"  for="active">Hiển thị</label>
                          
                        <input type="radio" class="btn-check" name="status" id="inactive" 
                        value="0" {{ old('status', 1) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger"  for="inactive">Ẩn</label>
                            @error('status')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            + Lưu bài viết
                        </button>

                        <a href="{{ route('admin.posts.index') }}"
                        class="btn btn-secondary">
                            Quay lại
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
    @endsection