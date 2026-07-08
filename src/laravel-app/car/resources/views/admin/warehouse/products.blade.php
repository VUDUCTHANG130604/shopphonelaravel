@extends('layouts.admin')

@section('title', 'Quản lý kho hàng')

@section('content')
<div class="warehouse-wrap">
    <div class="container-fluid px-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4 warehouse-stats-row">
            <div class="col-sm-6 col-xl-3">
                <div class="warehouse-stat-card stat-red">
                    <div class="warehouse-stat-icon"><i class="fa fa-cubes"></i></div>
                    <div class="warehouse-stat-info">
                        <p class="warehouse-stat-label">Tổng sản phẩm</p>
                        <h6 class="warehouse-stat-value">{{ number_format($statistics['total_products']) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="warehouse-stat-card stat-green">
                    <div class="warehouse-stat-icon"><i class="fa fa-archive"></i></div>
                    <div class="warehouse-stat-info">
                        <p class="warehouse-stat-label">Tổng tồn kho</p>
                        <h6 class="warehouse-stat-value">{{ number_format($statistics['total_quantity']) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="warehouse-stat-card stat-orange">
                    <div class="warehouse-stat-icon"><i class="fa fa-exclamation-triangle"></i></div>
                    <div class="warehouse-stat-info">
                        <p class="warehouse-stat-label">Sắp hết hàng</p>
                        <h6 class="warehouse-stat-value">{{ $statistics['low_stock'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="warehouse-stat-card stat-darkred">
                    <div class="warehouse-stat-icon"><i class="fa fa-times-circle"></i></div>
                    <div class="warehouse-stat-info">
                        <p class="warehouse-stat-label">Hết hàng</p>
                        <h6 class="warehouse-stat-value">{{ $statistics['out_of_stock'] }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="warehouse-content">
            <div class="warehouse-header">
                <h6 class="warehouse-title">Quản lý kho hàng</h6>
                <div class="warehouse-actions">
                    <a href="{{ route('admin.warehouse.import') }}" class="btn btn-warehouse btn-warehouse-success"><i class="fa fa-download"></i> Nhập hàng</a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-warehouse btn-warehouse-primary"><i class="fa fa-plus"></i> Thêm sản phẩm mới</a>
                </div>
            </div>

            <div class="warehouse-filter">
                <form method="get">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên sản phẩm..." value="{{ $keyword }}">
                    <select name="category_id" class="form-select">
                        <option value="0">Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" @selected($categoryId == $category->category_id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    @if($keyword || $categoryId)
                        <a href="{{ route('admin.warehouse') }}" class="btn btn-secondary"><i class="fa fa-refresh"></i> Reset</a>
                    @endif
                </form>
            </div>

            <div class="warehouse-table-container">
                <div class="table-responsive">
                    <table class="table warehouse-table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Tồn kho</th>
                                <th>Đã bán</th>
                                <th>Trạng thái</th>
                                <th>Giá bán</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rows as $product)
                                @php
                                    $stockClass = $product->quantity == 0 ? 'danger' : ($product->quantity < 10 ? 'warning' : 'success');
                                    $stockLabel = $product->quantity == 0 ? 'Hết hàng' : ($product->quantity < 10 ? 'Số lượng còn ít' : 'Còn hàng');
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}</td>
                                    <td><img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->name }}"></td>
                                    <td class="warehouse-product-name">{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '' }}</td>
                                    <td><strong>{{ $product->quantity }}</strong></td>
                                    <td>{{ $product->sell_quantity }}</td>
                                    <td><span class="stock-badge bg-{{ $stockClass }}">{{ $stockLabel }}</span></td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                                    <td>
                                        <button type="button" class="btn btn-action" data-bs-toggle="modal" data-bs-target="#adjustModal{{ $product->product_id }}" title="Điều chỉnh số lượng"><i class="fa fa-edit"></i></button>
                                        <div class="modal fade" id="adjustModal{{ $product->product_id }}" tabindex="-1">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Điều chỉnh số lượng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.warehouse.adjust') }}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                            <div class="mb-3">
                                                                <label class="form-label">Số lượng mới</label>
                                                                <input type="number" name="new_quantity" class="form-control" value="{{ $product->quantity }}" min="0" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="warehouse-empty">
                                        <i class="fa fa-inbox fa-3x mb-3"></i>
                                        <p>Không tìm thấy sản phẩm nào</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="warehouse-pagination">{{ $rows->links() }}</div>
        </div>
    </div>
</div>

<style>
.warehouse-wrap{background:linear-gradient(135deg,#fff5f7 0%,#fff 100%);min-height:100vh;padding:2rem 0}
.warehouse-stats-row{margin-bottom:2rem}
.warehouse-stat-card{background:#fff;border-radius:14px;padding:1.5rem;box-shadow:0 2px 8px rgba(220,38,38,.08);border:2px solid #fce4ec;display:flex;align-items:center;gap:1rem;height:100%;transition:.25s}
.warehouse-stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 22px rgba(220,38,38,.14)}
.warehouse-stat-icon{width:58px;height:58px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.7rem;flex:0 0 58px}
.stat-red .warehouse-stat-icon{background:#fee2e2;color:#b91c1c}
.stat-green .warehouse-stat-icon{background:#d1fae5;color:#047857}
.stat-orange .warehouse-stat-icon{background:#ffedd5;color:#c2410c}
.stat-darkred .warehouse-stat-icon{background:#fecaca;color:#7f1d1d}
.warehouse-stat-info{min-width:0}
.warehouse-stat-label{font-size:14px;color:#718096;font-weight:700;margin-bottom:.5rem}
.warehouse-stat-value{font-size:1.8rem;font-weight:800;color:#2d3748;line-height:1;margin:0}
.warehouse-content{background:#fff;border-radius:16px;box-shadow:0 2px 8px rgba(220,38,38,.08);border:2px solid #fce4ec;overflow:hidden}
.warehouse-header{padding:1.5rem;background:linear-gradient(135deg,#fff5f7 0%,#fff 100%);border-bottom:3px solid #dc2626;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem}
.warehouse-title{font-size:1.35rem;font-weight:800;color:#2d3748;margin:0}
.warehouse-actions{display:flex;gap:.5rem;flex-wrap:wrap}
.btn-warehouse{padding:.625rem 1.25rem;border-radius:10px;font-weight:700;font-size:.875rem;border:2px solid transparent;display:inline-flex;align-items:center;gap:.5rem;text-decoration:none}
.btn-warehouse-success{background:linear-gradient(135deg,#10b981 0%,#059669 100%);color:#fff;border-color:#10b981}
.btn-warehouse-primary{background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%);color:#fff;border-color:#dc2626}
.btn-warehouse:hover{transform:translateY(-2px);color:#fff}
.warehouse-filter{padding:1.5rem;background:#fff5f7;border-bottom:2px solid #fce4ec}
.warehouse-filter form{display:grid;grid-template-columns:minmax(220px,1fr) minmax(180px,220px) auto auto;gap:.75rem;align-items:center}
.warehouse-filter .form-control,.warehouse-filter .form-select{border:2px solid #e2e8f0;border-radius:10px;padding:.625rem 1rem;font-size:.9375rem}
.warehouse-filter .form-control:focus,.warehouse-filter .form-select:focus{border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.1)}
.warehouse-filter .btn{padding:.625rem 1.1rem;border-radius:10px;font-weight:700;white-space:nowrap}
.warehouse-filter .btn-primary{background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%);border-color:#dc2626;color:#fff}
.warehouse-filter .btn-secondary{background:#64748b;border-color:#64748b;color:#fff}
.warehouse-table-container{padding:1.5rem}
.warehouse-table{margin:0;min-width:980px}
.warehouse-table thead{background:linear-gradient(135deg,#fff5f7 0%,#fce4ec 100%)}
.warehouse-table thead th{color:#2d3748;font-weight:800;text-transform:uppercase;font-size:.75rem;letter-spacing:.05em;padding:1rem;border-bottom:3px solid #dc2626;border-top:0;white-space:nowrap}
.warehouse-table tbody tr{transition:.2s;border-bottom:1px solid #f1f5f9}
.warehouse-table tbody tr:hover{background:#fff7f8}
.warehouse-table td{padding:1rem;vertical-align:middle;color:#2d3748}
.warehouse-product-name{font-weight:700;min-width:180px}
.warehouse-table img{width:50px;height:50px;object-fit:cover;border-radius:10px;border:2px solid #fce4ec;background:#fff}
.stock-badge{padding:.375rem .875rem;border-radius:20px;font-size:.8125rem;font-weight:700;display:inline-flex;border:2px solid currentColor;white-space:nowrap}
.stock-badge.bg-success{background:#d1fae5!important;color:#065f46!important;border-color:#10b981}
.stock-badge.bg-warning{background:#ffedd5!important;color:#c2410c!important;border-color:#f97316}
.stock-badge.bg-danger{background:#fee2e2!important;color:#991b1b!important;border-color:#ef4444}
.btn-action{padding:.5rem;border-radius:8px;color:#dc2626;background:#fff5f7;border:2px solid #fce4ec;width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center}
.btn-action:hover{background:#dc2626;color:#fff;border-color:#dc2626}
.warehouse-empty{text-align:center;padding:3rem 1.5rem;color:#718096}
.warehouse-pagination{padding:1.5rem;border-top:2px solid #fce4ec}
.warehouse-pagination .pagination{margin:0;gap:.375rem;justify-content:center}
.warehouse-pagination .page-link{border:2px solid #fce4ec;color:#2d3748;border-radius:10px;padding:.5rem .875rem;font-weight:700;margin:0}
.warehouse-pagination .page-link:hover{background:#fff5f7;border-color:#dc2626;color:#dc2626}
.warehouse-pagination .page-item.active .page-link{background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%);border-color:#dc2626;color:#fff}
@media(max-width:992px){.warehouse-header{align-items:flex-start}.warehouse-actions{width:100%}.btn-warehouse{flex:1;justify-content:center}.warehouse-filter form{grid-template-columns:1fr}.warehouse-filter .btn{width:100%}}
@media(max-width:768px){.warehouse-wrap{padding:1rem 0}.container-fluid.px-4{padding-left:12px!important;padding-right:12px!important}.warehouse-stat-value{font-size:1.5rem}.warehouse-table-container{padding:1rem}.warehouse-table thead th,.warehouse-table td{padding:.75rem;font-size:.8125rem}}
</style>
@endsection
