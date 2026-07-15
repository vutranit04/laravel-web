    @extends('admin.layouts.admin')

    @section('content')

    <div class="container-fluid">

        <h1 class="mb-4 text-uppercase">
            Thêm bài viết mới
        </h1>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text"
                            name="title"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug bài viết</label>
                        <input type="text"
                            name="slug"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung bài viết</label>
                        <textarea name="content" 
                                class="form-control" 
                                rows="6" 
                                placeholder="Nhập nội dung chi tiết của bài viết..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh bài viết</label>
                        <input type="file" 
                            name="image" 
                            class="form-control" 
                            accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn tác giả (User)</label>
                        <select name="userid" class="form-select" required>
                            <option value="">-- Chọn người viết bài --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" selected>Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
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