@extends('layouts.app')

@php
    $statusText = match ((int) $order->status) {
        0 => 'Đã hủy',
        2 => 'Đã xác nhận',
        3 => 'Đang giao hàng',
        4 => 'Hoàn thành',
        default => 'Chờ xác nhận',
    };
    $statusClass = match ((int) $order->status) {
        0 => 'status-cancelled',
        2 => 'status-confirmed',
        3 => 'status-shipping',
        4 => 'status-completed',
        default => 'status-pending',
    };
    $orderDate = $order->date ?? $order->created_at;
    $deliveryDate = $orderDate ? \Carbon\Carbon::parse($orderDate)->addDays(5) : null;
@endphp

@section('title', 'Chi tiết đơn hàng #'.$order->order_id)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my-orderdetails.css') }}?v=cancel-button-right-2">
@endpush

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('account.show') }}" class="breadcrumb-item">Tài khoản</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('orders.index') }}" class="breadcrumb-item">Đơn hàng</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Chi tiết #{{ $order->order_id }}</span>
        </div>
    </div>
</div>

<div class="order-detail-section">
    <div class="container">
        <div class="order-detail-card">
            <div class="detail-header">
                <div class="header-left">
                    <h1 class="detail-title"><i class="fa fa-receipt"></i>Chi Tiết Đơn Hàng #{{ $order->order_id }}</h1>
                    <p class="detail-subtitle">Theo dõi trạng thái và thông tin đơn hàng của bạn</p>
                </div>
                <div class="order-status-badge {{ $statusClass }}"><i class="fa fa-info-circle"></i>{{ $statusText }}</div>
            </div>

            <div class="order-info-grid">
                <div class="info-box">
                    <div class="info-icon"><i class="far fa-calendar-check"></i></div>
                    <div class="info-content"><span class="info-label">Ngày đặt hàng</span><span class="info-value">{{ optional($orderDate)->format('d/m/Y') }}</span></div>
                </div>
                <div class="info-box">
                    <div class="info-icon"><i class="far fa-clock"></i></div>
                    <div class="info-content"><span class="info-label">Giao hàng dự kiến</span><span class="info-value">{{ optional($deliveryDate)->format('d/m/Y') }}</span></div>
                </div>
                <div class="info-box">
                    <div class="info-icon"><i class="fas fa-box"></i></div>
                    <div class="info-content"><span class="info-label">Trạng thái đơn hàng</span><span class="info-value status-text">{{ $statusText }}</span></div>
                </div>
            </div>

            <div class="tracking-section">
                <h3 class="section-title"><i class="fas fa-route"></i>Theo Dõi Đơn Hàng</h3>
                <div class="tracking-timeline">
                    <div class="timeline-line"></div>
                    <div class="timeline-steps">
                        <div class="timeline-step active"><div class="step-circle"><i class="fa fa-check"></i></div><div class="step-content"><span class="step-label">Đơn hàng đã đặt</span><span class="step-time">Chờ xác nhận</span></div></div>
                        <div class="timeline-step {{ $order->status >= 2 ? 'active' : '' }}"><div class="step-circle"><i class="fa fa-user-check"></i></div><div class="step-content"><span class="step-label">Đã xác nhận</span><span class="step-time">Shop đã xác nhận đơn</span></div></div>
                        <div class="timeline-step {{ $order->status >= 3 ? 'active' : '' }}"><div class="step-circle"><i class="fa fa-shipping-fast"></i></div><div class="step-content"><span class="step-label">Đang giao hàng</span><span class="step-time">Đơn hàng đang trên đường</span></div></div>
                        <div class="timeline-step {{ $order->status >= 4 ? 'active' : '' }}"><div class="step-circle"><i class="fa fa-check-double"></i></div><div class="step-content"><span class="step-label">Giao thành công</span><span class="step-time">Đơn hàng đã được giao</span></div></div>
                    </div>
                </div>
            </div>

            <div class="products-section">
                <h3 class="section-title"><i class="fas fa-box-open"></i>Sản Phẩm Đã Đặt ({{ $order->details->count() }} sản phẩm)</h3>
                <div class="products-list">
                    @foreach($order->details as $detail)
                        <div class="product-row">
                            <div class="product-image"><img src="{{ asset('upload/'.($detail->product->image ?? 'no-image.jpg')) }}" alt="{{ $detail->product->name ?? 'Sản phẩm' }}"></div>
                            <div class="product-details">
                                <h6 class="product-name">{{ $detail->product->name ?? 'Sản phẩm' }}</h6>
                                <div class="product-meta">
                                    <span class="product-price">{{ number_format($detail->price, 0, ',', '.') }}đ</span>
                                    <span class="product-separator">×</span>
                                    <span class="product-qty">{{ $detail->quantity }}</span>
                                </div>
                            </div>
                            <div class="product-total">
                                <span class="total-label">Thành tiền:</span>
                                <span class="total-value">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="summary-wrapper">
                <div class="customer-info">
                    <h3 class="section-title"><i class="fas fa-user"></i>Thông Tin Nhận Hàng</h3>
                    <div class="info-list">
                        <div class="info-row"><span class="info-key"><i class="fas fa-user-circle"></i>Họ và tên:</span><span class="info-val">{{ $order->user->full_name ?? $order->user->name }}</span></div>
                        <div class="info-row"><span class="info-key"><i class="fas fa-map-marker-alt"></i>Địa chỉ:</span><span class="info-val">{{ $order->address }}</span></div>
                        @if($order->note)<div class="info-row"><span class="info-key"><i class="fas fa-sticky-note"></i>Ghi chú:</span><span class="info-val">{{ $order->note }}</span></div>@endif
                    </div>
                </div>

                <div class="payment-summary">
                    <h3 class="section-title"><i class="fas fa-calculator"></i>Tổng Đơn Hàng</h3>
                    <div class="summary-list">
                        <div class="summary-item"><span class="sum-label">Tổng tiền hàng:</span><span class="sum-value">{{ number_format($order->total, 0, ',', '.') }}đ</span></div>
                        <div class="summary-item"><span class="sum-label">Phí vận chuyển:</span><span class="sum-value free">Miễn phí</span></div>
                        <div class="summary-divider"></div>
                        <div class="summary-item total"><span class="sum-label">Tổng thanh toán:</span><span class="sum-value">{{ number_format($order->total, 0, ',', '.') }}đ</span></div>
                    </div>
                </div>
            </div>

            <div class="order-actions">
                <a href="{{ route('orders.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i>Quay lại danh sách</a>
                @if((int) $order->status === 1)
                    <form class="cancel-order-form" method="post" action="{{ route('orders.cancel', $order->order_id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng #{{ $order->order_id }}?');">
                        @csrf
                        <button type="submit" class="btn-cancel-order"><i class="fa fa-times-circle"></i>Hủy đơn hàng</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
