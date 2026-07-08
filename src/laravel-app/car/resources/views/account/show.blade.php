@extends('layouts.app')

@section('title', 'Thông tin tài khoản')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')
<section class="account-section">
    <div class="breadcrumb-option mb-3">
        <div class="container">
            <div class="breadcrumb__links">
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                <span>Thông tin tài khoản</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">@include('account._nav')</div>
            <div class="col-lg-8">
                <div class="account-card">
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    <div class="card-header">
                        <h5 class="card-title">Thông tin tài khoản</h5>
                        <p class="card-subtitle">Quản lý thông tin cá nhân của bạn</p>
                    </div>

                    <div class="account-info">
                        <div class="info-row"><div class="info-label">Họ tên</div><div class="info-value">{{ Auth::user()->full_name ?? Auth::user()->name }}</div></div>
                        <div class="info-row"><div class="info-label">Email</div><div class="info-value">{{ Auth::user()->email }}</div></div>
                        <div class="info-row"><div class="info-label">Số điện thoại</div><div class="info-value">{{ Auth::user()->phone }}</div></div>
                        <div class="info-row"><div class="info-label">Tên tài khoản</div><div class="info-value">{{ Auth::user()->username }}</div></div>
                        <div class="info-row"><div class="info-label">Mật khẩu</div><div class="info-value">*********</div><div class="info-action"><a href="{{ route('account.password') }}" class="link-primary">Thay đổi</a></div></div>
                        <div class="info-row"><div class="info-label">Địa chỉ 1</div><div class="info-value">{{ Auth::user()->address }}</div><div class="info-action"><a href="{{ route('account.address') }}" class="link-primary">Thêm địa chỉ</a></div></div>
                        @if($address)<div class="info-row"><div class="info-label">Địa chỉ 2</div><div class="info-value">{{ $address->address }}</div></div>@endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('account.edit') }}" class="btn-edit"><i class="fa fa-edit"></i>Sửa hồ sơ</a>
                        <a href="{{ route('orders.index') }}" class="btn-orders"><i class="fa fa-shopping-bag"></i>Đơn mua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
