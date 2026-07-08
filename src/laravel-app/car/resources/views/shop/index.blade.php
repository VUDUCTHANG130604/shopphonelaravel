@extends('layouts.app')

@section('title', isset($category) ? $category->name : (request()->routeIs('shop.search') ? 'Tìm kiếm sản phẩm' : 'Cửa hàng'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endpush

@section('content')
<div class="page-breadcrumb">
    <div class="container-fluid">
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}" class="trail-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="trail-separator">/</span>
            @if(request()->routeIs('shop.search'))
                <a href="{{ route('shop.legacy') }}" class="trail-item">Tìm kiếm sản phẩm</a>
                <span class="trail-separator">/</span>
                <span class="trail-current">
                    @if(request('query'))
                        {{ request('query') }}
                    @elseif(request('from_price') !== null && request('to_price') !== null)
                        Giá từ {{ number_format((int) request('from_price'), 0, ',', '.') }}₫ đến {{ number_format((int) request('to_price'), 0, ',', '.') }}₫
                    @else
                        Tất cả sản phẩm
                    @endif
                </span>
            @else
                <span class="trail-current">{{ isset($category) ? $category->name : 'Sản phẩm' }}</span>
            @endif
        </div>
    </div>
</div>

<section class="shop-page">
    <div class="container-fluid">
        <div class="shop-layout">
            <aside class="shop-sidebar">
                <div class="sidebar-widget">
                    <div class="widget-header"><h4>DANH MỤC</h4></div>
                    <div class="category-menu">
                        @foreach($categories as $item)
                            <a href="{{ route('shop.category', $item->category_id) }}" class="menu-item {{ isset($category) && (int) $category->category_id === (int) $item->category_id ? 'active' : '' }}">
                                <span class="item-icon">›</span>{{ $item->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-widget">
                    <div class="widget-header"><h4>TÌM THEO GIÁ</h4></div>
                    <div class="price-filter">
                        <div class="price-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                            data-min="{{ (int) ($minMaxPrice->min_price ?? 0) }}"
                            data-max="{{ (int) ($minMaxPrice->max_price ?? 0) }}">
                        </div>
                        <form action="{{ route('shop.search') }}" method="get" class="filter-form">
                            <div class="price-inputs">
                                <div class="input-field">
                                    <label class="field-label">Giá từ:</label>
                                    <input type="text" name="from_price" id="minamount" class="field-input" value="{{ request('from_price') }}">
                                </div>
                                <div class="input-field">
                                    <label class="field-label">đến:</label>
                                    <input type="text" name="to_price" id="maxamount" class="field-input" value="{{ request('to_price') }}">
                                </div>
                            </div>
                            <button type="submit" class="filter-submit">
                                <i class="fa fa-filter"></i>
                                LỌC GIÁ
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="shop-content">
                @if($products->count() > 0)
                    <div class="product-list">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                    <div class="page-navigation">{{ $products->links('pagination::bootstrap-4') }}</div>
                @else
                    <div class="empty-results">
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="empty-title">Không tìm thấy kết quả</h3>
                        <p class="empty-message">Rất tiếc, chúng tôi không tìm thấy sản phẩm phù hợp với tìm kiếm của bạn. Vui lòng thử lại với từ khóa khác hoặc xem các danh mục sản phẩm.</p>
                        <div class="empty-actions">
                            <a href="{{ route('shop.legacy') }}" class="back-button">
                                <i class="fas fa-arrow-left"></i>
                                Trở lại cửa hàng
                            </a>
                            <a href="{{ route('home') }}" class="home-button">
                                <i class="fas fa-home"></i>
                                Về trang chủ
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/shop.js') }}"></script>
@endpush
