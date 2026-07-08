@extends('layouts.app')

@section('title', 'Đăng ký')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-wrapper register">
            <div class="auth-card">
                <div class="auth-header">
                    <h3>Đăng Ký Tài Khoản</h3>
                    <p>Tạo tài khoản mới để mua sắm</p>
                </div>

                <form action="{{ route('register.store') }}" method="post" class="auth-form" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_res">Email <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" id="email_res" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập địa chỉ email" value="{{ old('email') }}" required>
                                </div>
                                @error('email')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name">Họ và tên <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-user"></i>
                                    <input type="text" id="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Nhập họ và tên" value="{{ old('full_name') }}" required>
                                </div>
                                @error('full_name')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Tên đăng nhập <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-user-circle"></i>
                                    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nhập tên đăng nhập" value="{{ old('username') }}" required>
                                </div>
                                @error('username')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại" value="{{ old('phone') }}" required>
                                </div>
                                @error('phone')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address">Địa chỉ <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-map-marker"></i>
                                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Nhập địa chỉ" value="{{ old('address') }}" required>
                                </div>
                                @error('address')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_register">Mật khẩu <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" id="password_register" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu" required>
                                    <button type="button" class="toggle-password" onclick="toggleRegisterPassword()"><i class="fa fa-eye"></i></button>
                                </div>
                                @error('password')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirm">Xác nhận mật khẩu <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fa fa-check"></i>
                                    <input type="password" id="password_confirm" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Đăng Ký</button>

                    <div class="divider"><span>hoặc</span></div>

                    <div class="auth-footer">
                        <p>Đã có tài khoản?</p>
                        <a href="{{ route('login') }}" class="btn-login-link">Đăng Nhập Ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function toggleRegisterPassword() {
    ['password_register', 'password_confirm'].forEach(function(id) {
        var input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    });
}
</script>
@endpush
