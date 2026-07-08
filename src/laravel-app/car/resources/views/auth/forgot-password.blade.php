@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <h3>Quên Mật Khẩu</h3>
                    <p>Nhập email và mật khẩu mới để khôi phục tài khoản</p>
                </div>

                <form action="{{ route('password.reset.simple') }}" method="post" class="auth-form" autocomplete="off">
                    @csrf
                    @if($errors->any())
                        <div class="alert-error"><i class="fa fa-exclamation-circle"></i><span>Vui lòng kiểm tra lại thông tin.</span></div>
                    @endif

                    <div class="form-group">
                        <label for="email_forgot">Email đăng ký</label>
                        <div class="input-with-icon">
                            <i class="fa fa-envelope"></i>
                            <input type="email" id="email_forgot" name="email" class="form-control" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                        </div>
                        @error('email')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu mới</label>
                        <div class="input-with-icon">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                        </div>
                        @error('password')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Nhập lại mật khẩu</label>
                        <div class="input-with-icon">
                            <i class="fa fa-check"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Lấy Lại Mật Khẩu</button>

                    <div class="divider"><span>hoặc</span></div>

                    <div class="auth-footer">
                        <p>Đã nhớ mật khẩu?</p>
                        <a href="{{ route('login') }}" class="btn-register">Đăng Nhập</a>
                    </div>

                    <div class="auth-footer" style="margin-top: 1rem;">
                        <p>Chưa có tài khoản?</p>
                        <a href="{{ route('register') }}" class="btn-register">Tạo Tài Khoản Mới</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
