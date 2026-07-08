@extends('layouts.admin')

@section('title', $category->exists ? 'Cập nhật danh mục' : 'Thêm danh mục')

@section('content')
<div class="container-fluid pt-4" style="margin-bottom:110px;">
    <form class="row g-4" method="post" enctype="multipart/form-data" action="{{ $category->exists ? route('admin.categories.update', $category->category_id) : route('admin.categories.store') }}">
        @csrf
        @if($category->exists)
            @method('PUT')
        @endif

        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="{{ route('admin.categories') }}" class="link-not-hover">Danh mục</a>
                    / {{ $category->exists ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
                </h6>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>
                @endif

                <label for="floatingInput">Tên danh mục</label>
                <div class="form-floating mb-4">
                    <input name="name" type="text" value="{{ old('name', $category->name) }}" class="form-control" id="floatingInput" placeholder="Tên danh mục">
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

                <label for="floatingSelect">Trạng thái</label>
                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="floatingSelect">
                        <option value="1" @selected(old('status', $category->status ?? 1) == 1)>Hiển thị</option>
                        <option value="0" @selected(old('status', $category->status ?? 1) == 0)>Tạm ẩn</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label><br>
                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    <input style="background-color:#fff" name="image" class="form-control form-control-sm" id="formFileSm" type="file">
                    @if($category->image)
                        <div class="my-2">
                            <img src="{{ asset('upload/'.$category->image) }}" width="100%" class="img-thumbnail" alt="{{ $category->name }}">
                        </div>
                    @endif
                </div>
                <h6 class="mb-4">
                    <button type="submit" class="btn btn-custom">{{ $category->exists ? 'Cập nhật' : 'Đăng' }}</button>
                </h6>
            </div>
        </div>
    </form>
</div>
@endsection
