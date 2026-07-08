@extends('layouts.admin')

@section('title', $post->exists ? 'Cập nhật bài viết' : 'Thêm bài viết')

@section('content')
<div class="container-fluid pt-4" style="margin-bottom:110px;">
    <form class="row g-4" method="post" enctype="multipart/form-data" action="{{ $post->exists ? route('admin.posts.update', $post->post_id) : route('admin.posts.store') }}">
        @csrf
        @if($post->exists)
            @method('PUT')
        @endif

        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="{{ route('admin.posts') }}" class="link-not-hover">Bài viết</a>
                    / {{ $post->exists ? 'Cập nhật bài viết' : 'Thêm bài viết' }}
                </h6>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>
                @endif

                <label for="floatingInput">Tiêu đề bài viết</label>
                <div class="form-floating mb-4">
                    <input name="title" value="{{ old('title', $post->title) }}" type="text" class="form-control" id="floatingInput" placeholder="Tiêu đề bài viết">
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <label for="short_description">Nội dung bài viết</label>
                @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                <div class="form-floating mb-3">
                    <textarea name="content" class="form-control" placeholder="Nội dung" id="short_description">{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label><br>
                    <input style="background-color:#fff" name="image" class="form-control form-control-sm" id="formFileSm" type="file">
                    @if($post->image)
                        <div class="my-2">
                            <img src="{{ asset('upload/'.$post->image) }}" width="100%" class="img-thumbnail" alt="{{ $post->title }}">
                        </div>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select" id="floatingSelect">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Chọn chuyên mục</label>
                </div>
                <input type="hidden" name="author" value="{{ old('author', $post->author ?: 'Admin') }}">
                <input type="hidden" name="status" value="{{ old('status', $post->status ?? 1) ? 1 : 0 }}">
                <h6 class="mb-4">
                    <button type="submit" class="btn btn-custom">{{ $post->exists ? 'Cập nhật' : 'Đăng' }}</button>
                </h6>
            </div>
        </div>
    </form>
</div>

<style>
.ck-editor__editable[role="textbox"]:first-child{min-height:300px}.ck-content .image{max-width:80%;margin:20px auto}
</style>
@endsection
