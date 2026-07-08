@extends('layouts.app')

@section('title', 'Giỏ hàng')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('shop.legacy') }}" class="breadcrumb-item">Cửa hàng</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Giỏ hàng</span>
        </div>
    </div>
</div>

@if(session('success'))<div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>@endif
@if(session('error'))<div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>@endif

@if($cart->isNotEmpty())
<section class="shop-cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-header">
                    <div class="cart-header-left">
                        <i class="fa fa-shopping-cart"></i>
                        <h4>Giỏ Hàng</h4>
                    </div>
                    <span class="cart-count">{{ $cart->count() }} sản phẩm</span>
                </div>

                <form action="{{ route('cart.update-many') }}" method="post" id="cartForm">
                    @csrf
                    @method('PUT')
                    <div class="cart-items">
                        @php $totalPayment = 0; @endphp
                        @foreach($cart as $item)
                            @php
                                $totalPrice = $item['price'] * $item['quantity'];
                                $totalPayment += $totalPrice;
                            @endphp
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <a href="{{ route('product.detail', $item['product_id']) }}">
                                        <img src="{{ asset('upload/'.$item['image']) }}" alt="{{ $item['name'] }}">
                                    </a>
                                </div>

                                <div class="cart-item-details">
                                    <div class="cart-item-info">
                                        <h6 class="cart-item-name">
                                            <a href="{{ route('product.detail', $item['product_id']) }}">{{ $item['name'] }}</a>
                                        </h6>
                                        <div class="cart-item-rating">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </div>
                                    </div>

                                    <div class="cart-item-price">
                                        <span class="price-label">Đơn giá:</span>
                                        <span class="price-value">{{ number_format($item['price'], 0, ',', '.') }}đ</span>
                                    </div>

                                    <div class="cart-item-quantity">
                                        <input type="hidden" name="product_id[]" value="{{ $item['product_id'] }}">
                                        <div class="quantity-control">
                                        <button type="button" class="qty-btn qty-minus">−</button>
                                        <input type="number" readonly step="1" value="{{ $item['quantity'] }}" name="quantity[]" class="qty-input">
                                        <button type="button" class="qty-btn qty-plus">+</button>
                                        </div>
                                    </div>

                                    <div class="cart-item-total">
                                        <span class="total-label">Tổng:</span>
                                        <span class="total-value">{{ number_format($totalPrice, 0, ',', '.') }}đ</span>
                                    </div>

                                    <div class="cart-item-remove">
                                        <button type="button" class="remove-btn" onclick="if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) document.getElementById('delete-cart-{{ $item['product_id'] }}').submit();">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-actions">
                        <a href="{{ route('shop.legacy') }}" class="btn-continue">
                            <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                        <button type="submit" class="btn-update">
                            <i class="fa fa-refresh"></i> Cập nhật giỏ hàng
                        </button>
                    </div>
                </form>
                @foreach($cart as $item)
                    <form id="delete-cart-{{ $item['product_id'] }}" method="post" action="{{ route('cart.destroy', $item['product_id']) }}" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <div class="summary-header">
                        <i class="fa fa-calculator"></i>
                        <h5>Tổng Đơn Hàng</h5>
                    </div>
                    <div class="summary-content">
                        <div class="summary-row"><span>Số lượng sản phẩm:</span><span class="highlight">{{ $cart->count() }}</span></div>
                        <div class="summary-row subtotal"><span>Tạm tính:</span><span>{{ number_format($totalPayment, 0, ',', '.') }}đ</span></div>
                        <div class="summary-row shipping"><span>Phí vận chuyển:</span><span class="free-shipping">Miễn phí</span></div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total"><span>Tổng cộng:</span><span>{{ number_format($totalPayment, 0, ',', '.') }}đ</span></div>
                    </div>
                    <div class="checkout-buttons">
                        <a href="{{ route('checkout') }}" class="btn-checkout"><i class="fa fa-credit-card"></i> Thanh Toán COD</a>
                        <a href="{{ route('checkout.momo') }}" class="btn-checkout mt-2" style="background:#d82d8b"><i class="fa fa-credit-card"></i> Thanh Toán MoMo</a>
                    </div>
                    <div class="payment-security"><i class="fa fa-shield"></i><span>Giao dịch bảo mật & an toàn</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<div class="empty-cart-section">
    <div class="container">
        <div class="empty-cart-content">
            <div class="empty-cart-icon"><i class="fa fa-shopping-cart"></i></div>
            <h3>Giỏ Hàng Trống</h3>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
            <div class="empty-cart-actions">
                <a href="{{ route('shop.legacy') }}" class="btn-shop-now"><i class="fa fa-shopping-bag"></i> Khám Phá Sản Phẩm</a>
                <a href="{{ route('home') }}" class="btn-home"><i class="fa fa-home"></i> Về Trang Chủ</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.qty-plus').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            input.value = (parseInt(input.value) || 1) + 1;
        });
    });
    document.querySelectorAll('.qty-minus').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            const value = parseInt(input.value) || 1;
            if (value > 1) input.value = value - 1;
        });
    });
});
</script>
@endpush
