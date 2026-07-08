@extends('layouts.admin')

@section('title', $isRecycle ? 'Thùng rác sản phẩm' : 'Sản phẩm')

@push('styles')
<style>
.products-list-wrapper{padding:1.5rem}
.products-list-card{background:#fff;border-radius:.5rem;box-shadow:0 1px 3px rgba(0,0,0,.1);border:1px solid #e5e7eb}
.products-list-header{padding:1rem 1.5rem;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;justify-content:space-between}
.products-list-title{font-size:1.125rem;font-weight:600;color:#1f2937;margin:0}
.products-btn-add{padding:.5rem 1rem;background:#dc2626;color:#fff;font-size:.875rem;font-weight:500;border-radius:.5rem;display:inline-flex;align-items:center;gap:.5rem;text-decoration:none}
.products-btn-add:hover{background:#b91c1c;color:#fff}
.products-filter-section{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.products-tabs{display:flex;align-items:center;gap:1.5rem;font-size:.875rem}
.products-tab-link{color:#6b7280;text-decoration:none}
.products-tab-link.active{color:#dc2626;font-weight:500;border-bottom:2px solid #dc2626;padding-bottom:.25rem}
.products-tab-count{color:#9ca3af}
.products-search-form{display:flex;align-items:center;gap:.5rem}
.products-form-input,.products-form-select{padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:.5rem;font-size:.875rem;outline:none;background:#fff}
.products-form-input{width:200px}
.products-btn-filter{padding:.5rem 1rem;background:#f3f4f6;color:#374151;font-size:.875rem;font-weight:500;border-radius:.5rem;border:none;cursor:pointer}
.products-table-wrapper{overflow:visible}
.products-table{width:100%;border-collapse:collapse}
.products-table thead{background:#fff5f6;border-top:1px solid #fde2e7;border-bottom:1px solid #fde2e7}
.products-table th{padding:.75rem 1.5rem;text-align:left;font-size:.75rem;font-weight:600;color:#991b1b;text-transform:uppercase;letter-spacing:.05em}
.products-table th:last-child{text-align:right}
.products-table tbody tr{border-bottom:1px solid #e5e7eb;transition:background .15s}
.products-table tbody tr:hover{background:#fff7f7}
.products-table td{padding:1rem 1.5rem;font-size:.875rem}
.products-td-index{color:#6b7280}
.products-td-name{color:#111827;font-weight:500;min-width:200px}
.products-img{width:48px;height:48px;object-fit:cover;border-radius:.25rem;background:#f8f9fa}
.products-price-original{color:#6b7280;text-decoration:line-through}
.products-price-sale{color:#dc2626;font-weight:600}
.products-td-actions{text-align:right}
.products-action-dropdown{position:relative;display:inline-block}
.products-dropdown-toggle{color:#9ca3af;cursor:pointer;background:none;border:none;font-size:1.25rem}
.products-dropdown-menu{display:none;position:absolute;right:0;z-index:50;margin-top:.5rem;min-width:160px;background:#fff;border-radius:.5rem;box-shadow:0 10px 15px -3px rgba(0,0,0,.1);border:1px solid #e5e7eb;overflow:hidden;text-align:left}
.products-dropdown-menu.show{display:block}
.products-dropdown-item{display:block;width:100%;padding:.5rem 1rem;font-size:.875rem;color:#374151;text-decoration:none;border:0;background:#fff;text-align:left}
.products-dropdown-item:hover{background:#f9fafb}
.products-dropdown-item.danger{color:#dc2626}
.products-pagination-wrapper{padding:1rem 1.5rem;border-top:1px solid #e5e7eb}
@media(max-width:768px){.products-list-wrapper{padding:1rem}.products-list-header,.products-filter-section{flex-direction:column;align-items:flex-start}.products-btn-add{width:100%;justify-content:center}.products-search-form{width:100%;flex-wrap:wrap}.products-form-input,.products-form-select{flex:1;min-width:150px}.products-table-wrapper{overflow-x:auto}}
</style>
@endpush

@section('content')
<div class="products-list-wrapper">
    <div class="products-list-card">
        <div class="products-list-header">
            <h2 class="products-list-title">{{ $isRecycle ? 'Thùng rác sản phẩm' : 'Sản phẩm' }}</h2>
            <a href="{{ route('admin.products.create') }}" class="products-btn-add"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
        </div>

        @if(session('success'))<div class="alert alert-success m-3">{{ session('success') }}</div>@endif

        <div class="products-filter-section">
            <div class="products-tabs">
                <a href="{{ route('admin.products') }}" class="products-tab-link {{ $isRecycle ? '' : 'active' }}">Tất cả <span class="products-tab-count">({{ $totalProducts }})</span></a>
                <a href="{{ route('admin.products.recycle') }}" class="products-tab-link {{ $isRecycle ? 'active' : '' }}">Thùng rác <span class="products-tab-count">({{ $recycleCount }})</span></a>
            </div>

            @unless($isRecycle)
                <form action="{{ route('admin.products') }}" method="get" class="products-search-form">
                    <input type="search" name="keyword" class="products-form-input" placeholder="Tìm sản phẩm" value="{{ $keyword }}">
                    <select class="products-form-select" name="category_id">
                        <option value="0">Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" @selected($categoryId === (int) $category->category_id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="products-btn-filter">Lọc</button>
                </form>
            @endunless
        </div>

        <div class="products-table-wrapper">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá gốc</th>
                        <th>Giá bán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $product)
                        <tr>
                            <td class="products-td-index">{{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}</td>
                            <td class="products-td-name">{{ $product->name }}</td>
                            <td><img class="products-img" src="{{ asset('upload/'.($product->image ?: 'no-image.jpg')) }}" alt="{{ $product->name }}"></td>
                            <td class="products-price-original">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                            <td class="products-price-sale">{{ number_format($product->sale_price, 0, ',', '.') }}đ</td>
                            <td class="products-td-actions">
                                <div class="products-action-dropdown">
                                    <button type="button" class="products-dropdown-toggle"><i class="bi bi-three-dots-vertical"></i></button>
                                    <div class="products-dropdown-menu">
                                        <a class="products-dropdown-item" href="{{ route('product.detail', $product->product_id) }}" target="_blank">Xem chi tiết</a>
                                        @if($isRecycle)
                                            <form method="post" action="{{ route('admin.products.restore', $product->product_id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="products-dropdown-item">Khôi phục</button>
                                            </form>
                                            <form method="post" action="{{ route('admin.products.force-destroy', $product->product_id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="products-dropdown-item danger" onclick="return confirmDeletion();">Xóa vĩnh viễn</button>
                                            </form>
                                        @else
                                            <a class="products-dropdown-item" href="{{ route('admin.products.edit', $product->product_id) }}">Chỉnh sửa</a>
                                            <form method="post" action="{{ route('admin.products.destroy', $product->product_id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="products-dropdown-item danger" onclick="return confirmDeletionTemp();">Xóa tạm thời</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">{{ $isRecycle ? 'Thùng rác rỗng.' : 'Chưa có sản phẩm.' }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="products-pagination-wrapper">{{ $rows->links() }}</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.products-dropdown-toggle').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var menu = this.nextElementSibling;
            document.querySelectorAll('.products-dropdown-menu').forEach(function(item) {
                if (item !== menu) item.classList.remove('show');
            });
            menu.classList.toggle('show');
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.products-action-dropdown')) {
            document.querySelectorAll('.products-dropdown-menu').forEach(function(item) {
                item.classList.remove('show');
            });
        }
    });
});
</script>
@endpush
