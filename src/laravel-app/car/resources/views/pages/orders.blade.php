@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my-order.css') }}">
@endpush

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('login') }}" class="breadcrumb-item">Tài khoản</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Đơn hàng</span>
        </div>
    </div>
</div>

<div class="orders-section">
    <div class="container">
        <div class="page-header">
            <div>
                <h1 class="page-title">Đơn Hàng Của Tôi</h1>
                <p class="page-description">Quản lý và theo dõi đơn hàng của bạn</p>
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $orders->total() }}</span>
                    <span class="stat-label">Tổng đơn</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="order-alert order-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="order-alert order-alert-error">{{ session('error') }}</div>
        @endif

        @forelse($orders as $order)
            @php
                $statusMap = [
                    0 => ['Đã hủy', 'status-cancelled', 'fa-times-circle'],
                    1 => ['Chờ xác nhận', 'status-pending', 'fa-clock'],
                    2 => ['Đã xác nhận', 'status-confirmed', 'fa-check-circle'],
                    3 => ['Đang giao hàng', 'status-shipping', 'fa-truck'],
                    4 => ['Hoàn thành', 'status-completed', 'fa-check-double'],
                ];
                [$orderStatus, $statusClass, $statusIcon] = $statusMap[$order->status] ?? $statusMap[1];
            @endphp
            <div class="order-card">
                <div class="order-header">
                    <div class="order-header-left">
                        <div class="order-id"><i class="fa fa-receipt"></i><span>Đơn hàng #{{ $order->order_id }}</span></div>
                        <div class="order-date"><i class="far fa-calendar-alt"></i><span>{{ optional($order->date)->format('d/m/Y H:i') }}</span></div>
                    </div>
                    <div class="order-status {{ $statusClass }}"><i class="fa {{ $statusIcon }}"></i><span>{{ $orderStatus }}</span></div>
                </div>

                <div class="order-body">
                    <div class="products-grid">
                        @foreach($order->details->take(3) as $detail)
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="{{ asset('upload/'.($detail->product->image ?? 'no-image.jpg')) }}" alt="{{ $detail->product->name ?? 'Sản phẩm' }}">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name">{{ $detail->product->name ?? 'Sản phẩm' }}</h6>
                                    <div class="product-meta">
                                        <span class="product-price">{{ number_format($detail->price, 0, ',', '.') }}đ</span>
                                        <span class="product-quantity">× {{ $detail->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($order->details->count() > 3)
                            <div class="product-item more-products">
                                <div class="more-icon"><i class="fas fa-box"></i></div>
                                <div class="more-text"><span>+{{ $order->details->count() - 3 }} sản phẩm</span></div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        <span class="total-label">Tổng thanh toán:</span>
                        <span class="total-amount">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                    </div>
                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn-view-detail">
                        Xem chi tiết <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-orders">
                <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
                <h3 class="empty-title">Chưa Có Đơn Hàng</h3>
                <p class="empty-description">Bạn chưa có đơn hàng nào. Hãy khám phá và mua sắm ngay!</p>
                <a href="{{ route('shop.legacy') }}" class="btn-shop-now"><i class="fas fa-shopping-cart"></i> Khám Phá Sản Phẩm</a>
            </div>
        @endforelse

        {{ $orders->links() }}
    </div>
</div>
@endsection
