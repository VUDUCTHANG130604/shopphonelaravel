@extends('layouts.app')

@section('title', 'Đăng nhập')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-header">
                    <h3>Đăng Nhập</h3>
                    <p>Chào mừng bạn quay trở lại</p>
                </div>

                <form action="{{ route('login.store') }}" method="post" class="auth-form" autocomplete="off">
                    @csrf
                    @if(request('redirect'))
                        <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                    @endif
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if(session('error'))<div class="alert-error"><i class="fa fa-exclamation-circle"></i><span>{{ session('error') }}</span></div>@endif
                    @error('login')<div class="alert-error"><i class="fa fa-exclamation-circle"></i><span>{{ $message }}</span></div>@enderror

                    <div class="form-group">
                        <label for="username">Tên đăng nhập hoặc email</label>
                        <div class="input-with-icon">
                            <i class="fa fa-user"></i>
                            <input type="text" id="username" name="login" class="form-control" placeholder="Nhập tên đăng nhập hoặc email" value="{{ old('login') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-with-icon">
                            <i class="fa fa-lock"></i>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password')"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('password.request') }}" class="forgot-link">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="btn-submit">Đăng Nhập</button>

                    <div class="divider"><span>hoặc</span></div>

                    <div class="auth-footer">
                        <p>Chưa có tài khoản?</p>
                        <a href="{{ route('register') }}" class="btn-register">Tạo Tài Khoản Mới</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function togglePassword(id) {
    var input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endpush
