@extends('layouts.admin')

@section('title', 'Thêm tài khoản')

@section('content')
<div class="container-fluid pt-4" style="margin-bottom:110px;">
    <form class="row g-4" method="post" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="{{ route('admin.users') }}" class="link-not-hover">Tài khoản</a>
                    / Thêm tài khoản
                </h6>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>
                @endif

                <label>Email</label>
                <div class="mb-1">
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Họ và tên</label>
                <div class="mb-1">
                    <input name="full_name" type="text" class="form-control" value="{{ old('full_name') }}" required>
                    @error('full_name')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Tên đăng nhập</label>
                <div class="mb-1">
                    <input name="username" type="text" value="{{ old('username') }}" class="form-control" required>
                    @error('username')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Mật khẩu</label>
                <div class="mb-1">
                    <input name="password" type="password" class="form-control" required>
                    @error('password')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Xác nhận mật khẩu</label>
                <div class="mb-1">
                    <input name="password_confirm" type="password" class="form-control" required>
                    @error('password_confirm')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Số điện thoại</label>
                <div class="mb-1">
                    <input name="phone" type="text" value="{{ old('phone') }}" class="form-control" required>
                    @error('phone')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label>Địa chỉ</label>
                <div class="mb-1">
                    <input name="address" type="text" value="{{ old('address') }}" class="form-control" required>
                    @error('address')<span class="text-danger err">{{ $message }}</span>@enderror
                </div>

                <label for="Select">Vai trò</label>
                <div class="mb-3">
                    <select name="role" class="form-select" id="Select">
                        <option value="0" @selected(old('role', 0) == 0)>Khách hàng</option>
                        <option value="1" @selected(old('role') == 1)>Nhân viên</option>
                    </select>
                </div>
                <input type="hidden" name="active" value="1">
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <button type="submit" class="btn btn-custom">Thêm tài khoản</button>
                </h6>
            </div>
        </div>
    </form>
</div>

<style>
.err{display:inline-block;min-height:22px}
</style>
@endsection
