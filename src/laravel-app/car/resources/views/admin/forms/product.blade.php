@extends('layouts.admin')

@section('title', $product->exists ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm')

@section('content')
<style>
.product-container{padding-top:1.5rem}.product-grid{display:grid;grid-template-columns:1fr;gap:1.5rem}@media(min-width:1280px){.product-grid{grid-template-columns:2fr 1fr}}.product-card{background:#fff;border-radius:.5rem;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:1.5rem}.product-title{font-size:1.125rem;font-weight:600;color:#111827;margin-bottom:1.5rem}.product-title a{color:#3b82f6;text-decoration:none}.product-title a:hover{color:#2563eb}.form-label{display:block;font-size:.875rem;font-weight:500;color:#374151;margin-bottom:.5rem}.form-group{margin-bottom:1.5rem}.form-input,.form-textarea,.form-select{width:100%;padding:.625rem .875rem;font-size:.875rem;line-height:1.5;color:#111827;background:#fff;border:1px solid #d1d5db;border-radius:.375rem;transition:all .15s}.form-input:focus,.form-textarea:focus,.form-select:focus{outline:0;border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.1)}.form-textarea{resize:vertical;min-height:100px}.form-file{display:block;width:100%;padding:.5rem;font-size:.875rem;color:#374151;background:#fff;border:1px solid #d1d5db;border-radius:.375rem;cursor:pointer}.error-text{display:block;font-size:.875rem;color:#dc2626;margin-top:.375rem}.image-preview{margin-top:1rem;border-radius:.375rem;overflow:hidden;border:1px solid #e5e7eb}.image-preview img{width:100%;height:auto;display:block}.btn-group-old{display:flex;gap:.75rem;flex-wrap:wrap}.btn-submit{display:inline-block;padding:.625rem 1.5rem;font-size:.875rem;font-weight:500;color:#fff;background:#3b82f6;border:0;border-radius:.375rem;cursor:pointer;text-decoration:none;text-align:center}.btn-submit:hover{background:#2563eb;color:#fff}.btn-danger-old{background:#ef4444}.btn-danger-old:hover{background:#dc2626}.alert-old{padding:.875rem 1rem;border-radius:.375rem;margin-bottom:1.5rem;font-size:.875rem}.alert-success-old{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534}.alert-error-old{background:#fef2f2;border:1px solid #fecaca;color:#991b1b}.ck-editor__editable[role=textbox]:first-child{min-height:300px;border-radius:.375rem}
</style>

<div class="container-fluid product-container">
    <form class="product-grid" method="post" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product->product_id) : route('admin.products.store') }}">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif

        <div>
            <div class="product-card">
                <h6 class="product-title">
                    <a href="{{ route('admin.products') }}">Sản phẩm</a>
                    / {{ $product->exists ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm' }}
                </h6>

                @if(session('success'))
                    <div class="alert-old alert-success-old">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert-old alert-error-old">Vui lòng kiểm tra lại thông tin.</div>
                @endif

                <div class="form-group">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-input" placeholder="Tên sản phẩm">
                    @error('name')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Giá bán thường (đ)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price ?? 0) }}" class="form-input" placeholder="Giá bán thường (đ)">
                    @error('price')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Giá khuyến mãi (đ)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price ?? 0) }}" class="form-input" placeholder="Giá khuyến mãi (đ)">
                    @error('sale_price')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Số lượng (nhập số)</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? 0) }}" class="form-input" placeholder="Số lượng">
                    @error('quantity')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="short_description" class="form-textarea" placeholder="Mô tả ngắn" id="short_description">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Chi tiết sản phẩm</label>
                    <textarea name="details" class="form-textarea" placeholder="Mô tả" id="product_details" style="height:300px;">{{ old('details', $product->details) }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <div class="product-card">
                <div class="form-group">
                    <label class="form-label">Hình ảnh (JPG, PNG)</label>
                    <input class="form-file" name="image" id="formFileSm" type="file">
                    @error('image')<span class="error-text">{{ $message }}</span>@enderror
                    @if($product->image)
                        <div class="image-preview">
                            <img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">Chọn danh mục</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" @selected(old('category_id', $product->category_id) == $category->category_id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="error-text">{{ $message }}</span>@enderror
                </div>

                <input type="hidden" name="status" value="{{ old('status', $product->status ?? 1) ? 1 : 0 }}">

                <div class="btn-group-old">
                    <button type="submit" class="btn-submit">{{ $product->exists ? 'Cập nhật' : 'Đăng' }}</button>
                    @if($product->exists)
                        <a href="{{ route('admin.products') }}" class="btn-submit btn-danger-old">Quay lại</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
