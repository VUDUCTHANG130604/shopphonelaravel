@extends('layouts.app')

@section('title', 'Thanh toán MoMo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}?v=checkout-custom-confirm-4">
@endpush

@section('content')
@php
    $user = auth()->user();
    $totalPayment = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);
    $action = match ($mode) {
        'default' => route('checkout.momo.address.place'),
        'saved' => route('checkout.momo.address2.place'),
        default => route('checkout.momo.place'),
    };
    $selectedAddress = match ($mode) {
        'default' => $user->address,
        'saved' => optional($savedAddress)->address,
        default => old('address', $user->address),
    };
    $selectedPhone = $mode === 'custom' ? old('phone', $user->phone) : $user->phone;
    $readonlyAddress = $mode !== 'custom';
@endphp

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
                <a href="{{ route('shop.legacy') }}" class="btn-login">Xem Sản Phẩm</a>
                <a href="{{ route('home') }}" class="btn-home-alt">Về Trang Chủ</a>
            </div>
        </div>
    </div>
</div>
@else
<section class="checkout-section">
    <div class="container">
        <div class="checkout-header">
            <div class="checkout-header-content">
                <h3>Thanh Toán Đơn Hàng</h3>
                <a href="{{ route('cart.index') }}" class="back-to-cart">
                    <i class="fa fa-angle-left"></i> Quay lại giỏ hàng
                </a>
            </div>
        </div>

        <form action="{{ $action }}" method="post" class="checkout-form" id="momo-checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="checkout-card">
                        <div class="checkout-card-header">
                            <h5>Thông Tin Giao Hàng</h5>
                        </div>
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
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $selectedAddress }}" placeholder="Nhập địa chỉ giao hàng" @readonly($readonlyAddress)>
                                        @error('address')
                                            <div class="error-message"><i class="fa fa-exclamation-circle"></i>{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Số điện thoại <span class="required">*</span></label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $selectedPhone }}" placeholder="Nhập số điện thoại" @readonly($readonlyAddress)>
                                        @error('phone')
                                            <div class="error-message"><i class="fa fa-exclamation-circle"></i>{{ $message }}</div>
                                        @enderror
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
                                <div class="address-notice">
                                    <i class="fa fa-info-circle"></i>
                                    <span>Chọn địa chỉ đã lưu hoặc nhập địa chỉ mới</span>
                                </div>
                                <div class="address-buttons">
                                    @if($mode !== 'custom')
                                        <a href="{{ route('checkout.momo') }}" class="btn-address">
                                            <i class="fa fa-edit"></i> Nhập địa chỉ khác
                                        </a>
                                    @else
                                        <a href="{{ route('checkout.momo.address') }}" class="btn-address">
                                            <i class="fa fa-home"></i> Địa chỉ 1
                                        </a>
                                    @endif
                                    @if($savedAddress)
                                        <a href="{{ route('checkout.momo.address2') }}" class="btn-address">
                                            <i class="fa fa-map-marker"></i> Địa chỉ 2
                                        </a>
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

                        <div class="payment-method">
                            <div class="payment-badge payment-badge-momo">
                                <i class="fa fa-credit-card"></i>
                                <span>Thanh toán qua MoMo</span>
                            </div>
                        </div>

                        <button type="button" class="btn-place-order btn-place-order-momo" id="open-momo-confirm">
                            Thanh Toán MoMo
                        </button>

                        <div class="order-security">
                            <i class="fa fa-shield"></i>
                            <span>Giao dịch được bảo mật và mã hóa</span>
                        </div>

                        <div class="checkout-confirm-overlay" id="thanhtoan" hidden>
                            <div class="checkout-confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="momo-confirm-title">
                                <div class="checkout-modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="momo-confirm-title">Xác Nhận Đặt Hàng</h5>
                                        <button type="button" class="close" id="close-momo-confirm" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="confirm-icon confirm-icon-momo">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <p>Bạn sẽ được chuyển đến trang thanh toán MoMo</p>
                                        <div class="confirm-total">
                                            Tổng thanh toán: <strong>{{ number_format($totalPayment, 0, ',', '.') }}đ</strong>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn-modal-cancel" id="cancel-momo-confirm">Hủy bỏ</button>
                                        <button type="button" class="btn-modal-confirm btn-modal-confirm-momo" onclick="submitMomoCheckoutForm()">
                                            Xác nhận thanh toán
                                        </button>
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
    var openButton = document.getElementById('open-momo-confirm');
    var overlay = document.getElementById('thanhtoan');
    var closeButton = document.getElementById('close-momo-confirm');
    var cancelButton = document.getElementById('cancel-momo-confirm');

    if (!openButton || !overlay) {
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

function submitMomoCheckoutForm() {
    var form = document.getElementById('momo-checkout-form') || document.querySelector('.checkout-form');

    if (!form) {
        return;
    }

    var payInput = form.querySelector('input[name="payUrl"]');
    if (!payInput) {
        payInput = document.createElement('input');
        payInput.type = 'hidden';
        payInput.name = 'payUrl';
        payInput.value = '1';
        form.appendChild(payInput);
    }

    form.submit();
}
</script>
@endpush
