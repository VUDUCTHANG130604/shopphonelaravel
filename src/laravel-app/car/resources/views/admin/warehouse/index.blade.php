@extends('layouts.admin')

@section('title', 'Kho hàng')

@section('content')
<div class="panel">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="mb-3">
        <a class="btn btn-danger" href="{{ route('admin.warehouse.import') }}">Nhập hàng</a>
        <a class="btn btn-outline-secondary" href="{{ route('admin.warehouse.products') }}">Tồn kho sản phẩm</a>
    </div>
    <table class="table table-hover">
        <thead><tr><th>ID</th><th>Tên hàng</th><th>Giá nhập</th><th>Số lượng</th><th>Đã bán</th><th>Ngày nhập</th></tr></thead>
        <tbody>@foreach($rows as $row)<tr><td>{{ $row->id }}</td><td>{{ $row->name }}</td><td>{{ number_format($row->price, 0, ',', '.') }}đ</td><td>{{ $row->quantity }}</td><td>{{ $row->sell }}</td><td>{{ $row->created_at }}</td></tr>@endforeach</tbody>
    </table>
    {{ $rows->links() }}
</div>
@endsection
