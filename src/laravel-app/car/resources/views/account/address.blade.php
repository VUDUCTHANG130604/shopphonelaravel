@extends('layouts.app')

@section('title', 'Địa chỉ')

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
                <form class="account-card" method="post" action="{{ route('account.address.store') }}">
                    @csrf
                    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                    @if($errors->any())<div class="alert alert-danger">Vui lòng nhập địa chỉ.</div>@endif
                    <div class="card-header">
                        <h5 class="card-title">Địa chỉ nhận hàng</h5>
                        <p class="card-subtitle">Quản lý địa chỉ giao hàng của bạn</p>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" value="{{ old('address', $address->address ?? Auth::user()->address) }}" required>
                        @error('address')<span class="error-text">{{ $message }}</span>@enderror
                    </div>
                    <button class="site-btn">Lưu địa chỉ</button>
                    @if($address)
                        <a class="btn btn-outline-danger ml-2" href="{{ route('account.address.remove') }}" onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">Xóa địa chỉ</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
