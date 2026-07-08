@extends('layouts.app')

@section('title', 'Hồ sơ')

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
                <form class="account-card" method="post" enctype="multipart/form-data" action="{{ route('account.update') }}">
                    @csrf
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if($errors->any())<div class="alert alert-danger">Vui lòng kiểm tra lại thông tin.</div>@endif
                    <div class="card-header">
                        <h5 class="card-title">Sửa hồ sơ</h5>
                        <p class="card-subtitle">Quản lý thông tin cá nhân của bạn</p>
                    </div>
                    <div class="form-group">
                        <label>Họ tên <span class="required">*</span></label>
                        <input class="form-control" name="full_name" value="{{ old('full_name', Auth::user()->full_name ?? Auth::user()->name) }}" required>
                        @error('full_name')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại <span class="required">*</span></label>
                        <input class="form-control" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                        @error('phone')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ <span class="required">*</span></label>
                        <input class="form-control" name="address" value="{{ old('address', Auth::user()->address) }}" required>
                        @error('address')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input class="form-control-file" type="file" name="image">
                        @error('image')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <button class="site-btn">Lưu hồ sơ</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
