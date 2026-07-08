@extends('layouts.app')

@section('title', 'Thanh toán')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}?v=checkout-custom-confirm-4">
@endpush

@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>

@if($cart->isEmpty())
<div class="login-required-section">
    <div class="container">
        <div class="login-required-content">
            <div class="login-icon"><i class="fa fa-shopping-cart"></i></div>
            <h3>Giỏ hàng trống</h3>
            <p>Bạn cần thêm sản phẩm trước khi thanh toán</p>
            <div class="login-actions">
                <a href="{{ route('shop.legacy') }}" class="btn-login">Xem sản phẩm</a>
                <a href="{{ route('home') }}" class="btn-home-alt">Về Trang Chủ</a>
            </div>
        </div>
    </div>
</div>
@else
@php
    $user = auth()->user();
    $totalPayment = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);
    $mode = $mode ?? 'custom';
    $selectedAddress = match ($mode) {
        'default' => $user->address,
        'saved' => optional($savedAddress)->address,
        default => old('address', $user->address),
    };
    $selectedPhone = $mode === 'custom' ? old('phone', $user->phone) : $user->phone;
    $readonlyAddress = $mode !== 'custom';
@endphp
<section class="checkout-section">
    <div class="container">
        <div class="checkout-header">
            <div class="checkout-header-content">
                <h3>Thanh Toán Đơn Hàng</h3>
                <a href="{{ route('cart.index') }}" class="back-to-cart"><i class="fa fa-angle-left"></i> Quay lại giỏ hàng</a>
            </div>
        </div>

        <form method="post" action="{{ route('checkout.place') }}" class="checkout-form" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="checkout-card">
                        <div class="checkout-card-header"><h5>Thông Tin Giao Hàng</h5></div>
                        <div class="checkout-card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ và tên <span class="required">*</span></label>
                                        <input type="text" class="form-control" disabled value="{{ $user->full_name ?: $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="text" class="form-control" disabled value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Địa chỉ giao hàng <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $selectedAddress }}" placeholder="Nhập địa chỉ giao hàng" @readonly($readonlyAddress)>
                                        @error('address')<div class="error-message"><i class="fa fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Số điện thoại <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $selectedPhone }}" placeholder="Nhập số điện thoại" @readonly($readonlyAddress)>
                                        @error('phone')<div class="error-message"><i class="fa fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Ghi chú đơn hàng</label>
                                        <textarea class="form-control" name="note" rows="3" placeholder="Ghi chú về đơn hàng (tùy chọn)">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="address-options">
                                <div class="address-notice"><i class="fa fa-info-circle"></i><span>Chọn địa chỉ đã lưu hoặc nhập địa chỉ mới</span></div>
                                <div class="address-buttons">
                                    @if($mode !== 'custom')
                                        <a href="{{ route('checkout') }}" class="btn-address"><i class="fa fa-edit"></i> Nhập địa chỉ khác</a>
                                    @else
                                        <a href="{{ route('checkout.address') }}" class="btn-address"><i class="fa fa-home"></i> Địa chỉ 1</a>
                                    @endif
                                    @if($savedAddress)
                                        <a href="{{ route('checkout.address2') }}" class="btn-address"><i class="fa fa-map-marker"></i> Địa chỉ 2</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="order-summary">
                        <div class="order-summary-header">
                            <h5>Đơn Hàng Của Bạn</h5>
                            <span class="item-count">{{ $cart->count() }} sản phẩm</span>
                        </div>
                        <div class="order-items">
                            @foreach($cart as $index => $item)
                                @php $totalPrice = $item['price'] * $item['quantity']; @endphp
                                <div class="order-item">
                                    <div class="order-item-info">
                                        <div class="order-item-name">
                                            <span class="item-number">{{ $index + 1 }}.</span>
                                            {{ $item['name'] }}
                                            <div class="order-item-qty">x{{ $item['quantity'] }}</div>
                                        </div>
                                    </div>
                                    <div class="order-item-price">{{ number_format($totalPrice, 0, ',', '.') }}đ</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-calculation">
                            <div class="calc-row"><span>Tạm tính:</span><span>{{ number_format($totalPayment, 0, ',', '.') }}đ</span></div>
                            <div class="calc-row"><span>Phí vận chuyển:</span><span class="text-success">Miễn phí</span></div>
                            <div class="calc-divider"></div>
                            <div class="calc-row total"><span>Tổng cộng:</span><span>{{ number_format($totalPayment, 0, ',', '.') }}đ</span></div>
                        </div>
                        <div class="payment-method"><div class="payment-badge"><i class="fa fa-money"></i><span>Thanh toán khi nhận hàng (COD)</span></div></div>
                        <button type="button" class="btn-place-order" id="open-checkout-confirm">Đặt Hàng Ngay</button>
                        <div class="order-security"><i class="fa fa-shield"></i><span>Thông tin của bạn được bảo mật</span></div>

                        <div class="checkout-confirm-overlay" id="thanhtoan" hidden>
                            <div class="checkout-confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="checkout-confirm-title">
                                <div class="checkout-modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="checkout-confirm-title">Xác Nhận Đặt Hàng</h5>
                                        <button type="button" class="close" id="close-checkout-confirm" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="confirm-icon"><i class="fa fa-check"></i></div>
                                        <p>Bạn có chắc chắn muốn đặt đơn hàng này?</p>
                                        <div class="confirm-total">Tổng thanh toán: <strong>{{ number_format($totalPayment, 0, ',', '.') }}đ</strong></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-modal-cancel" id="cancel-checkout-confirm">Hủy bỏ</button>
                                        <button type="button" class="btn-modal-confirm" onclick="submitCheckoutForm()">Xác nhận đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var openButton = document.getElementById('open-checkout-confirm');
    var form = document.getElementById('checkout-form');
    var overlay = document.getElementById('thanhtoan');
    var closeButton = document.getElementById('close-checkout-confirm');
    var cancelButton = document.getElementById('cancel-checkout-confirm');

    if (!openButton || !form || !overlay) {
        return;
    }

    function openConfirm() {
        overlay.hidden = false;
        document.body.classList.add('checkout-confirm-open');
    }

    function closeConfirm() {
        overlay.hidden = true;
        document.body.classList.remove('checkout-confirm-open');
    }

    openButton.addEventListener('click', openConfirm);

    if (closeButton) {
        closeButton.addEventListener('click', closeConfirm);
    }

    if (cancelButton) {
        cancelButton.addEventListener('click', closeConfirm);
    }

    overlay.addEventListener('click', function (event) {
        if (event.target === overlay) {
            closeConfirm();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !overlay.hidden) {
            closeConfirm();
        }
    });
});

function submitCheckoutForm() {
    var form = document.getElementById('checkout-form') || document.querySelector('.checkout-form');

    if (!form) {
        return;
    }

    form.submit();
}
</script>
@endpush
