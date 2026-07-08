@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')
<section class="account-section checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">@include('account._nav')</div>
            <div class="col-lg-8">
                <form class="account-card" method="post" action="{{ route('account.password.update') }}">
                    @csrf
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if($errors->any())<div class="alert alert-danger">Vui lòng kiểm tra lại mật khẩu.</div>@endif
                    <div class="card-header">
                        <h5 class="card-title">Đổi mật khẩu</h5>
                        <p class="card-subtitle">Cập nhật mật khẩu của bạn để bảo mật tài khoản</p>
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input class="form-control" value="{{ Auth::user()->username }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu cũ <span class="required">*</span></label>
                        <input class="form-control" type="password" name="current_password" required>
                        @error('current_password')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới <span class="required">*</span></label>
                        <input class="form-control" type="password" name="password" required>
                        @error('password')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu mới <span class="required">*</span></label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-notice">
                        <i class="fa fa-info-circle"></i>
                        <span>Mật khẩu phải có ít nhất 8 ký tự</span>
                    </div>
                    <button class="site-btn">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
