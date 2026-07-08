@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng #'.$order->order_id)

@section('content')
@php
    $statusMap = [
        0 => 'Đã hủy',
        1 => 'Chờ xác nhận',
        2 => 'Đã xác nhận',
        3 => 'Đang giao',
        4 => 'Giao thành công',
    ];
    $statusText = $statusMap[(int) $order->status] ?? 'Không xác định';
    $customerName = $order->user->full_name ?? $order->user->name ?? 'Khách hàng';
    $orderDate = $order->date ? $order->date->format('d/m/Y H:i') : '';
@endphp

<div class="order-detail-wrap">
    <div class="container-fluid px-4">
        <div class="order-card">
            <div class="order-header">
                <h6 class="breadcrumb-old">
                    <a href="{{ route('admin.orders') }}">Đơn hàng</a> / Chi tiết đơn hàng #{{ $order->order_id }}
                </h6>
            </div>

            <div class="order-body">
                @if(session('success'))
                    <div class="alert-old">{{ session('success') }}</div>
                @endif

                <ul class="product-list">
                    @foreach($order->details as $detail)
                        @php($detailProduct = $detail->product)
                        <li class="product-item">
                            <img src="{{ asset('upload/'.($detailProduct->image ?? 'default-product.jpg')) }}" class="product-img" alt="{{ $detailProduct->name ?? 'Sản phẩm' }}">
                            <div class="product-info">
                                <p class="product-name">{{ $detailProduct->name ?? 'Sản phẩm' }}</p>
                                <div>
                                    <span class="product-price">{{ number_format($detail->price, 0, ',', '.') }}đ</span>
                                    <span class="product-qty">x{{ $detail->quantity }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="info-card">
                            <h6>Trạng thái đơn hàng: <span class="status-label">{{ $statusText }}</span></h6>

                            <form method="post" action="{{ route('admin.orders.status', $order->order_id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group-old">
                                    <label for="status-select" class="form-label-old">Trạng thái</label>
                                    <select name="status" class="form-select-old" id="status-select">
                                        <option value="1" @selected($order->status == 1)>Chờ xác nhận</option>
                                        <option value="2" @selected($order->status == 2)>Đã xác nhận</option>
                                        <option value="3" @selected($order->status == 3)>Đang giao</option>
                                        <option value="4" @selected($order->status == 4)>Giao thành công</option>
                                        <option value="0" @selected($order->status == 0)>Đã hủy</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-update">Cập nhật</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="info-card">
                            <h6>Thông tin đơn hàng</h6>

                            <div class="info-row"><span class="info-label">Tên khách hàng</span><span class="info-value">{{ $customerName }}</span></div>
                            <div class="info-row"><span class="info-label">Số điện thoại</span><span class="info-value">{{ $order->phone }}</span></div>
                            <div class="info-row"><span class="info-label">Địa chỉ giao hàng</span><span class="info-value">{{ $order->address }}</span></div>
                            <div class="info-row"><span class="info-label">Thời gian</span><span class="info-value">{{ $orderDate }}</span></div>
                            <div class="info-row"><span class="info-label">Tổng tiền hàng</span><span class="info-value">{{ number_format($order->total, 0, ',', '.') }}đ</span></div>
                            <div class="info-row"><span class="info-label">Phí vận chuyển</span><span class="info-value">Miễn phí</span></div>
                            <div class="info-row"><span class="info-label">Ghi chú</span><span class="info-value">{{ $order->note ?: 'Không có' }}</span></div>

                            <div class="total-divider"></div>

                            <div class="total-row">
                                <span class="total-label">Thành tiền</span>
                                <span class="total-value">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-detail-wrap{background:linear-gradient(135deg,#fff5f7 0%,#fff 100%);min-height:100vh;padding:2rem 0}
.order-card{background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(220,38,38,.08);border:2px solid #fce4ec;overflow:hidden}
.order-header{padding:1rem 1.5rem;border-bottom:3px solid #dc2626;background:linear-gradient(135deg,#fff5f7 0%,#fff 100%)}
.breadcrumb-old{font-size:.95rem;color:#6b7280;margin:0;font-weight:700}
.breadcrumb-old a{color:#dc2626;text-decoration:none}
.breadcrumb-old a:hover{text-decoration:underline}
.order-body{padding:1.5rem}
.product-list{list-style:none;padding:0;margin:0 0 2rem;display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem}
.product-item{display:flex;gap:1rem;padding:1rem;border:1px solid #fce4ec;border-radius:10px;transition:.15s;background:#fff}
.product-item:hover{box-shadow:0 6px 14px rgba(220,38,38,.1);transform:translateY(-2px)}
.product-img{width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #fce4ec;background:#fff5f7;flex:0 0 80px}
.product-info{flex:1;min-width:0}
.product-name{font-size:.875rem;font-weight:800;color:#111827;margin-bottom:.5rem;line-height:1.35}
.product-price{font-size:.875rem;color:#dc2626;font-weight:800}
.product-qty{color:#6b7280;margin-left:.5rem}
.info-card{background:#fff;border:1px solid #fce4ec;border-radius:10px;padding:1.5rem;height:100%}
.info-card h6{font-size:1rem;font-weight:800;color:#111827;margin-bottom:1.5rem}
.status-label{color:#dc2626;font-weight:800}
.form-group-old{margin-bottom:1rem}
.form-label-old{font-size:.875rem;color:#6b7280;font-weight:700;margin-bottom:.5rem;display:block}
.form-select-old{width:100%;padding:.625rem .75rem;font-size:.875rem;border:2px solid #e5e7eb;border-radius:8px;background:#fff}
.form-select-old:focus{outline:0;border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.12)}
.btn-update{background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%);color:#fff;padding:.625rem 1.5rem;border:0;border-radius:8px;font-size:.875rem;font-weight:800;cursor:pointer}
.btn-update:hover{transform:translateY(-1px)}
.info-row{display:flex;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid #f3f4f6;gap:1rem}
.info-row:last-child{border-bottom:0}
.info-label{font-size:.875rem;color:#6b7280;font-weight:700}
.info-value{font-size:.875rem;color:#111827;text-align:right;font-weight:600;max-width:65%}
.total-divider{border-top:2px solid #fce4ec;margin:1rem 0}
.total-row{display:flex;justify-content:space-between;align-items:center;padding-top:1rem}
.total-label{font-size:.875rem;color:#6b7280;font-weight:800}
.total-value{font-size:1.5rem;color:#dc2626;font-weight:900}
.alert-old{padding:.875rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-size:.875rem;background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;font-weight:700}
@media(max-width:768px){.order-detail-wrap{padding:1rem 0}.container-fluid.px-4{padding-left:12px!important;padding-right:12px!important}.order-body{padding:1rem}.product-list{grid-template-columns:1fr}.info-row{flex-direction:column;gap:.25rem}.info-value{text-align:left;max-width:100%}}
</style>
@endsection
