@extends('layouts.admin')

@section('title', 'Thống kê sản phẩm')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Thống sản phẩm theo danh mục</h6>
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá thấp nhất</th>
                        <th scope="col">Giá cao nhất</th>
                        <th scope="col">Giá trung bình</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categoryStats as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="min-width:120px">{{ $row->cate_name }}</td>
                            <td>{{ $row->count_products }}</td>
                            <td>{{ number_format((float) $row->min_price, 0, ',', '.') }}đ</td>
                            <td>{{ number_format((float) $row->max_price, 0, ',', '.') }}đ</td>
                            <td>{{ number_format((float) $row->avg_product, 0, ',', '.') }}đ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá thấp nhất</th>
                        <th scope="col">Giá cao nhất</th>
                        <th scope="col">Giá trung bình</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
