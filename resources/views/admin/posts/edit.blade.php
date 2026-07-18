    @extends('admin.layouts.admin')
    @section('title','Sửa bài viết')
    @section('content')

    <div class="container-fluid">

        <h1 class="mb-4 text-uppercase">
            Sửa bài viết 
        </h1>
  @if(session ('error'))
        <div class=" alert alert-danger">
            {{ session ('error') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.posts.update',$post->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text"
                            name="title"
                            value="{{ old('title',$post->title) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug bài viết</label>
                        <input type="text"
                            name="slug"
                            value="{{ old('slug',$post->slug) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung bài viết</label>
                        <textarea name="content" 
                                class="form-control" 
                                rows="6" 
                                placeholder="Nhập nội dung chi tiết của bài viết..." required>{{ old('content',$post->content) }}</textarea>
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
                                <option value="{{ $user->id }}" {{ old('userid' , $post->userid ) == $user->id ? 'selected' : '' }}>{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                           <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Ẩn</option>
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