@extends('layouts.admin')

@section('title', 'Thống kê đơn hàng')

@push('styles')
<style>
.stats-container{background:#fff;border-radius:.5rem;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:1.5rem}
.stats-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
.stats-title{font-size:1.125rem;font-weight:600;color:#1f2937;margin:0}
.btn-chart{display:inline-flex;align-items:center;padding:.5rem 1rem;background:#2563eb;color:#fff;font-size:.875rem;font-weight:500;border-radius:.5rem;text-decoration:none;transition:background .2s}
.btn-chart:hover{background:#1d4ed8;color:#fff}
.stats-table{width:100%;border-collapse:separate;border-spacing:0}
.stats-table thead{background:#f9fafb}
.stats-table th{padding:.75rem 1rem;text-align:left;font-size:.75rem;font-weight:500;color:#374151;text-transform:uppercase;letter-spacing:.05em;border-bottom:1px solid #e5e7eb}
.stats-table tbody tr{border-bottom:1px solid #e5e7eb;transition:background .15s}
.stats-table tbody tr:hover{background:#f9fafb}
.stats-table td{padding:.75rem 1rem;font-size:.875rem;color:#111827}
.stats-table td.sold-count{font-weight:500;color:#2563eb}
</style>
@endpush

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="stats-container">
        <div class="stats-header">
            <h6 class="stats-title">Thống kê đơn hàng</h6>
            <a href="{{ route('admin.stats.chart', ['top' => 10]) }}" class="btn-chart">Xem biểu đồ</a>
        </div>

        <div class="table-responsive">
            <table class="stats-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Đơn hàng</th>
                        <th scope="col">Đã bán</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="min-width:120px">{{ $row->cate_name }}</td>
                            <td style="min-width:250px">{{ $row->product_name }}</td>
                            <td>{{ $row->count_orders }}</td>
                            <td class="sold-count">{{ $row->total_sold_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
