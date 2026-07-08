@extends('layouts.admin')

@section('title', 'Đơn hàng')

@push('styles')
<style>
.orders-wrap{background-color:#f9fafb;min-height:100vh;padding:2rem 0}
.orders-card{background:#fff;border-radius:.5rem;box-shadow:0 1px 3px 0 rgba(0,0,0,.1);overflow:hidden;padding:10px}
.orders-header{padding:1.5rem;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:10px}
.orders-title{font-size:1.25rem;font-weight:600;color:#111827;margin:0}
.orders-actions{display:flex;align-items:center;gap:.75rem}
.orders-actions-label{color:#fff;font-size:.875rem;font-weight:500}
.btn-export{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;background:#3b82f6;color:#fff;border:none;border-radius:.375rem;font-size:.875rem;font-weight:500;text-decoration:none;transition:background .15s}
.btn-export:hover{background:#2563eb;color:#fff}
.table-wrap{overflow-x:auto}
.orders-table{border-collapse:collapse;width:100%;margin-top:10px!important}
.orders-table thead{background:#f9fafb;border-bottom:1px solid #e5e7eb}
.orders-table thead th{padding:.75rem 1rem;text-align:left;font-size:.75rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.05em}
.orders-table tbody tr{border-bottom:1px solid #f3f4f6;transition:background .15s}
.orders-table tbody tr:hover{background:#f9fafb}
.orders-table tbody td{padding:1rem;font-size:.875rem;color:#111827}
.td-name{font-weight:500}
.td-date{color:#6b7280}
.td-price{font-weight:600;color:#111827}
.status-badge{display:inline-block;padding:.25rem .75rem;border-radius:9999px;font-size:.75rem;font-weight:500;text-decoration:none}
.status-cancelled{background:#f3f4f6;color:#6b7280}
.status-pending{background:#fee2e2;color:#991b1b}
.status-confirmed{background:#fef3c7;color:#92400e}
.status-shipping{background:#dbeafe;color:#1e40af}
.status-completed{background:#d1fae5;color:#065f46}
.order-actions{display:flex;gap:.5rem}
.btn-action{display:inline-flex;align-items:center;gap:.25rem;padding:.375rem .75rem;border-radius:.375rem;font-size:.75rem;font-weight:500;text-decoration:none;transition:all .15s}
.btn-view{background:#fff;color:#3b82f6;border:1px solid #3b82f6}
.btn-view:hover{background:#3b82f6;color:#fff}
.btn-edit{background:#fff;color:#6b7280;border:1px solid #d1d5db}
.btn-edit:hover{background:#f9fafb;color:#111827;border-color:#9ca3af}
@media(max-width:768px){.orders-wrap{padding:1rem 0}.orders-header{flex-direction:column;align-items:flex-start}.orders-actions{width:100%;justify-content:space-between}.orders-table{min-width:800px}.order-actions{flex-direction:column;width:100%}.btn-action{width:100%;justify-content:center}}
</style>
@endpush

@section('content')
<div class="orders-wrap">
    <div class="container">
        <div class="orders-card">
            @if(session('success'))<div class="alert alert-success m-3">{{ session('success') }}</div>@endif
            <div class="orders-header">
                <h6 class="orders-title">Danh sách đơn hàng</h6>
                <div class="orders-actions">
                    <span class="orders-actions-label">Xuất Excel:</span>
                    <a href="{{ route('admin.export.orders') }}" class="btn-export"><i class="fas fa-download"></i><span>Tất cả</span></a>
                </div>
            </div>

            <div class="table-wrap">
                <table class="orders-table" id="orders-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $order)
                            @php
                                $status = match ((int) $order->status) {
                                    0 => ['Đã hủy', 'status-cancelled'],
                                    2 => ['Đã xác nhận', 'status-confirmed'],
                                    3 => ['Đang giao', 'status-shipping'],
                                    4 => ['Giao thành công', 'status-completed'],
                                    default => ['Chờ xác nhận', 'status-pending'],
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="td-name">{{ $order->full_name ?: $order->name ?: 'Khách hàng' }}</td>
                                <td class="td-date">{{ optional($order->date ? \Carbon\Carbon::parse($order->date) : null)->format('d/m/Y H:i') }}</td>
                                <td class="td-price">{{ number_format($order->total, 0, ',', '.') }}đ</td>
                                <td><span class="status-badge {{ $status[1] }}">{{ $status[0] }}</span></td>
                                <td>
                                    <div class="order-actions">
                                        <a class="btn-action btn-view" href="{{ route('admin.orders.show', $order->order_id) }}">Xem</a>
                                        <a class="btn-action btn-edit" href="{{ route('admin.orders.show', $order->order_id) }}">Sửa</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6">Chưa có đơn hàng.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
