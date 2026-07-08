@extends('layouts.app')

@section('title', $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/productdetail.css') }}?v={{ filemtime(public_path('css/productdetail.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}?v={{ filemtime(public_path('css/shop.css')) }}">
@endpush

@section('content')
@php
    $discount = $product->price > 0 && $product->price > $product->sale_price
        ? round((($product->price - $product->sale_price) / $product->price) * 100)
        : 0;
@endphp

<div class="watch-breadcrumb">
    <div class="watch-container">
        <div class="watch-breadcrumb-list">
            <a href="{{ route('home') }}" class="watch-breadcrumb-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="watch-breadcrumb-separator">/</span>
            <a href="{{ route('shop.legacy') }}" class="watch-breadcrumb-item">Sản phẩm</a>
            <span class="watch-breadcrumb-separator">/</span>
            @if($product->category)
                <a href="{{ route('shop.category', $product->category_id) }}" class="watch-breadcrumb-item">{{ $product->category->name }}</a>
                <span class="watch-breadcrumb-separator">/</span>
            @endif
            <span class="watch-breadcrumb-current">{{ $product->name }}</span>
        </div>
    </div>
</div>

<section class="watch-detail-section">
    <div class="watch-container">
        <div class="watch-detail-grid">
            <div class="watch-images-col">
                <div class="watch-main-image">
                    @if($discount > 0)<div class="watch-discount-badge">-{{ $discount }}%</div>@endif
                    <img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->name }}" id="mainProductImage" class="watch-main-img">
                </div>
                <div class="watch-thumbnails">
                    <div class="watch-thumb active"><img src="{{ asset('upload/'.$product->image) }}" alt="" onclick="changeMainImage(this)"></div>
                    <div class="watch-thumb"><img src="{{ asset('upload/'.$product->image) }}" alt="" onclick="changeMainImage(this)"></div>
                    <div class="watch-thumb"><img src="{{ asset('upload/'.$product->image) }}" alt="" onclick="changeMainImage(this)"></div>
                </div>
            </div>

            <div class="watch-info-col">
                <h1 class="watch-product-title">{{ $product->name }}</h1>

                <div class="watch-category-line">
                    Danh mục:
                    @if($product->category)
                        <a href="{{ route('shop.category', $product->category_id) }}" class="watch-category-link">{{ $product->category->name }}</a>
                    @else
                        <span>Chưa phân loại</span>
                    @endif
                </div>

                <div class="watch-rating-line">
                    <div class="watch-stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    <span class="watch-review-text">({{ $product->comments->count() }} đánh giá)</span>
                </div>

                <div class="watch-price-line">
                    <span class="watch-current-price">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
                    @if($product->price > $product->sale_price)
                        <span class="watch-original-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                    @endif
                </div>

                <div class="watch-short-desc">{!! $product->short_description ?: 'Sản phẩm chính hãng, bảo hành rõ ràng.' !!}</div>

                @if((int) $product->quantity === 0)
                    <div class="watch-out-of-stock">
                        <button class="watch-stock-btn" disabled>Hết hàng</button>
                    </div>
                @else
                    @auth
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <div class="watch-quantity-box">
                                <label class="watch-qty-label">Số lượng:</label>
                                <div class="watch-qty-controls">
                                    <button type="button" class="watch-qty-btn" onclick="decreaseQty()">-</button>
                                    <input type="number" name="product_quantity" id="productQty" value="1" min="1" max="{{ $product->quantity }}" class="watch-qty-input">
                                    <button type="button" class="watch-qty-btn" onclick="increaseQty({{ $product->quantity }})">+</button>
                                </div>
                                <span class="watch-stock-text">{{ $product->quantity }} sản phẩm có sẵn</span>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <div class="watch-button-group">
                                <button type="submit" name="add_to_cart" value="1" class="watch-btn watch-btn-outline"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ</button>
                                <button type="submit" name="buy_now" value="1" class="watch-btn watch-btn-solid"><i class="fas fa-bolt"></i> Mua ngay</button>
                            </div>
                        </form>
                    @else
                        <div class="watch-quantity-box">
                            <label class="watch-qty-label">Số lượng:</label>
                            <div class="watch-qty-controls">
                                <button type="button" class="watch-qty-btn" disabled>-</button>
                                <input type="number" value="1" min="1" class="watch-qty-input" readonly>
                                <button type="button" class="watch-qty-btn" disabled>+</button>
                            </div>
                            <span class="watch-stock-text">{{ $product->quantity }} sản phẩm có sẵn</span>
                        </div>
                        <div class="watch-button-group">
                            <button class="watch-btn watch-btn-outline" onclick="alert('Vui lòng đăng nhập để thực hiện chức năng'); window.location.href='{{ route('login') }}';"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ</button>
                            <button class="watch-btn watch-btn-solid" onclick="alert('Vui lòng đăng nhập để thực hiện chức năng'); window.location.href='{{ route('login') }}';"><i class="fas fa-bolt"></i> Mua ngay</button>
                        </div>
                    @endauth

                    <div class="watch-extra-actions">
                        <button class="watch-extra-btn"><i class="far fa-heart"></i> Yêu thích</button>
                        <button class="watch-extra-btn"><i class="fas fa-share-alt"></i> Chia sẻ</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="watch-tabs-section">
            <div class="watch-tabs-nav">
                <button class="watch-tab-btn active" data-tab="description">Mô tả sản phẩm</button>
                <button class="watch-tab-btn" data-tab="reviews">Đánh giá ({{ $product->comments->count() }})</button>
            </div>
            <div class="watch-tabs-content">
                <div class="watch-tab-panel active" id="description">
                    <div class="watch-description-text">{!! $product->details ?: $product->short_description !!}</div>
                </div>
                <div class="watch-tab-panel" id="reviews">
                    <div class="watch-comments-section">
                        <h6 class="watch-comments-title">Bình luận ({{ $product->comments->count() }})</h6>
                        <div class="watch-comments-grid">
                            <div class="watch-comments-list">
                                @forelse($product->comments as $comment)
                                    <div class="watch-comment-item">
                                        <div class="watch-comment-header">
                                            <img src="{{ asset('upload/'.($comment->user->image ?? 'user-default.png')) }}" alt="Avatar" class="watch-comment-avatar">
                                            <div class="watch-comment-meta">
                                                <h6 class="watch-comment-author">{{ $comment->user->full_name ?? $comment->user->name ?? 'Khách hàng' }}</h6>
                                                <span class="watch-comment-date">{{ optional($comment->date)->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <p class="watch-comment-text">{{ $comment->content }}</p>
                                    </div>
                                @empty
                                    <div class="watch-no-comments">
                                        <span class="watch-empty-text">Chưa có bình luận nào</span>
                                    </div>
                                @endforelse
                            </div>

                            <div class="watch-comment-form-wrapper">
                                @auth
                                    <div class="watch-comment-form">
                                        <h4 class="watch-form-title">Để lại bình luận</h4>
                                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                                        <form method="post" action="{{ route('product.comment', $product->product_id) }}">
                                            @csrf
                                            <div class="watch-form-group">
                                                <label for="message" class="watch-form-label">Nội dung *</label>
                                                <textarea id="message" name="content" required rows="5" class="watch-form-textarea" placeholder="Nhập nội dung bình luận của bạn..."></textarea>
                                            </div>
                                            <div class="watch-form-actions">
                                                <button type="submit" class="watch-submit-btn">Gửi bình luận</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="watch-comment-form watch-login-prompt">
                                        <div class="watch-login-content">
                                            <h4 class="watch-login-title">Vui lòng đăng nhập để có thể bình luận</h4>
                                            <a href="{{ route('login') }}" class="watch-login-btn">Đăng nhập ngay</a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($similarProducts->isNotEmpty())
            <div class="watch-similar-products">
                <h2 class="watch-similar-title">Sản phẩm tương tự</h2>
                <div class="watch-products-grid">
                    @foreach($similarProducts as $similarProduct)
                        <x-product-card :product="$similarProduct" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
function changeMainImage(thumbnail) {
    const mainImage = document.getElementById('mainProductImage');
    mainImage.src = thumbnail.src;
    document.querySelectorAll('.watch-thumb').forEach((item) => item.classList.remove('active'));
    thumbnail.parentElement.classList.add('active');
}

function increaseQty(max) {
    const input = document.getElementById('productQty');
    const currentValue = parseInt(input.value) || 1;
    if (currentValue < max) input.value = currentValue + 1;
}

function decreaseQty() {
    const input = document.getElementById('productQty');
    const currentValue = parseInt(input.value) || 1;
    if (currentValue > 1) input.value = currentValue - 1;
}

document.querySelectorAll('.watch-tab-btn').forEach((tab) => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.watch-tab-btn').forEach((item) => item.classList.remove('active'));
        document.querySelectorAll('.watch-tab-panel').forEach((item) => item.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});
</script>
@endpush
