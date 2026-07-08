@extends('layouts.admin')

@section('title', 'Chuyên mục bài viết')

@section('content')
@php
    $editing = isset($editCategory) && $editCategory;
@endphp

<div class="container-fluid pt-4 post-category-page" style="margin-bottom:110px;">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-5">
            <form method="post" action="{{ $editing ? route('admin.post-categories.update', $editCategory->id) : route('admin.post-categories.store') }}">
                @csrf
                @if($editing)
                    @method('PUT')
                @endif
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">
                        <a href="{{ route('admin.posts') }}" class="link-hover">Bài viết</a> /
                        <a href="{{ route('admin.post-categories') }}" class="link-not-hover">Chuyên mục</a>
                        / {{ $editing ? 'Cập nhật chuyên mục' : 'Thêm chuyên mục' }}
                    </h6>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>
                    @endif

                    <label for="floatingInput">Tên chuyên mục</label>
                    <div class="form-floating mb-4">
                        <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Tên chuyên mục" value="{{ old('name', $editing ? $editCategory->name : '') }}">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-custom">{{ $editing ? 'Cập nhật chuyên mục' : 'Thêm chuyên mục' }}</button>
                    @if($editing)
                        <a href="{{ route('admin.post-categories') }}" class="btn btn-secondary ms-2">Hủy</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-sm-12 col-xl-7">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Danh sách chuyên mục</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Bài viết</th>
                                <th scope="col">Chỉnh sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $category)
                                <tr>
                                    <td>{{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->posts_count }}</td>
                                    <td>
                                        <a href="{{ route('admin.post-categories', ['edit' => $category->id]) }}" class="btn-sm btn-secondary">Sửa</a>
                                        <form class="d-inline" method="post" action="{{ route('admin.post-categories.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger border-0" onclick="return confirm('Bạn có chắc muốn xóa chuyên mục này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $rows->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
