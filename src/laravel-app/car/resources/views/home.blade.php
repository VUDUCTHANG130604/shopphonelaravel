@extends('layouts.app')

@section('title', 'THANG Mobile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')
<section class="banner-carousel">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" style="border-radius: 10px;">
                    @foreach(['slider_1.png', 'slider_2.png', 'slider_3.png'] as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img class="img-fluid" src="{{ asset('upload/banner/'.$banner) }}" alt="Banner">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width:45px;height:45px">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width:45px;height:45px">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@foreach(['banner-phone-nho-2.png', 'banner-phone-nho-3.png'] as $banner)
    <div class="promo-banner">
        <a href="{{ route('shop.legacy') }}" class="promo-link">
            <img class="promo-img" src="{{ asset('upload/banner/'.$banner) }}" alt="Banner khuyến mãi">
        </a>
    </div>
@endforeach

<section class="product-showcase">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="heading-text">Sản phẩm mới</h2>
        </div>
        <div class="product-list">
            @foreach($listProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="view-all-wrapper">
            <a href="{{ route('shop.legacy') }}" class="view-all-btn">Xem tất cả</a>
        </div>
    </div>
</section>

<div class="promo-banner">
    <a href="{{ route('shop.legacy') }}" class="promo-link">
        <img class="promo-img" src="{{ asset('upload/banner/banner-phone-nho-4.png') }}" alt="Banner khuyến mãi">
    </a>
</div>

<section class="product-showcase">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="heading-text">Sản phẩm bán chạy</h2>
        </div>
        <div class="product-list">
            @foreach($listProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
        <div class="view-all-wrapper">
            <a href="{{ route('shop.legacy') }}" class="view-all-btn">Xem tất cả</a>
        </div>
    </div>
</section>

<section class="trending-section">
    <div class="container-fluid">
        <div class="trending-grid">
            @foreach(['Xu hướng' => $product_limit_3, 'Bán chạy' => $product_order_by, 'Hot sale' => $product_limit_3] as $title => $products)
                <div class="trending-column">
                    <h4 class="trending-heading">{{ $title }}</h4>
                    @foreach($products as $product)
                        <div class="trending-item">
                            <div class="trending-thumb">
                                <a href="{{ route('product.detail', $product->product_id) }}">
                                    <img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="trending-info">
                                <h6 class="trending-name">
                                    <a href="{{ route('product.detail', $product->product_id) }}">{{ $product->name }}</a>
                                </h6>
                                <div class="rating-stars">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                                <div class="trending-price">{{ number_format($product->sale_price, 0, ',', '.') }}đ</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($list_posts->isNotEmpty())
<section class="news-section">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="heading-text">Tin tức</h2>
        </div>
        <div class="news-grid">
            @foreach($list_posts as $post)
                <article class="news-card">
                    <a href="{{ route('blog.show', $post->post_id) }}" class="news-link">
                        <div class="news-image">
                            <img src="{{ asset('upload/'.$post->image) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="news-content">
                            <h3 class="news-title">{{ $post->title }}</h3>
                            <div class="news-meta">
                                <i class="far fa-clock"></i>
                                <span>{{ optional($post->created_at)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="reviews-section">
    <div class="container-fluid">
        <div class="section-heading">
            <h2 class="heading-text">Đánh giá từ khách hàng</h2>
        </div>

        <div class="reviews-grid">
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        <img src="{{ asset('img/blog/details/comment-1.jpg') }}" alt="Nhã Phương">
                    </div>
                    <div class="reviewer-info">
                        <h4 class="reviewer-name">Nhã Phương - Diễn viên</h4>
                        <div class="review-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                </div>
                <div class="review-content">
                    <p>Mình mua iPhone 15 Pro Max ở đây, giá tốt, máy chính hãng VN/A. Nhân viên tư vấn nhiệt tình, giải thích rõ ràng về bảo hành. Giao hàng nhanh, đóng gói cẩn thận.</p>
                </div>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        <img src="{{ asset('img/blog/details/comment-2.jpg') }}" alt="Ngọc Trinh">
                    </div>
                    <div class="reviewer-info">
                        <h4 class="reviewer-name">Ngọc Trinh - Người mẫu</h4>
                        <div class="review-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                </div>
                <div class="review-content">
                    <p>Cửa hàng có nhiều mẫu điện thoại cao cấp, từ Samsung, iPhone đến Xiaomi. Không gian trưng bày đẹp, máy để thử nghiệm đầy đủ.</p>
                </div>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        <img src="{{ asset('img/blog/details/comment-3.jpg') }}" alt="Trấn Thành">
                    </div>
                    <div class="reviewer-info">
                        <h4 class="reviewer-name">Trấn Thành - Danh hài</h4>
                        <div class="review-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                </div>
                <div class="review-content">
                    <p>Mình hay phải thay điện thoại vì công việc, cửa hàng này phục vụ nhanh, giá cạnh tranh. Có chương trình thu cũ đổi mới rất hợp lý.</p>
                </div>
            </div>

            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        <img src="{{ asset('upload/avatar_it.png') }}" alt="Trường Giang">
                    </div>
                    <div class="reviewer-info">
                        <h4 class="reviewer-name">Trường Giang - Danh hài</h4>
                        <div class="review-rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    </div>
                </div>
                <div class="review-content">
                    <p>Shop có nhiều phụ kiện đi kèm rất tiện, từ ốp lưng, dán cường lực đến sạc dự phòng. Nhân viên nhiệt tình hướng dẫn sử dụng chi tiết.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="promo-banner mt-5">
        <a href="{{ route('shop.legacy') }}" class="promo-link">
            <img class="promo-img" src="{{ asset('upload/banner/banner-phone-nho-6.png') }}" alt="Banner khuyến mãi">
        </a>
    </div>
</section>
@endsection
