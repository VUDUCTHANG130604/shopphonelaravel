@props(['product'])

@php
    $discount = $product->price > 0 && $product->price > $product->sale_price
        ? round((($product->price - $product->sale_price) / $product->price) * 100)
        : 0;
@endphp

<div class="product-box">
    @if($discount > 0)
        <div class="sale-tag">-{{ $discount }}%</div>
    @endif

    <div class="product-image-wrapper">
        <img src="{{ asset('upload/'.$product->image) }}" alt="{{ $product->name }}" class="product-image">
        <div class="product-actions-overlay">
            <div class="action-buttons">
                <a href="{{ asset('upload/'.$product->image) }}" class="image-popup action-btn"><span class="arrow_expand"></span></a>
                <a href="{{ route('product.detail', $product->product_id) }}" class="action-btn"><i class="fas fa-search"></i></a>
                <form action="{{ route('cart.store') }}" method="post" class="inline-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="product_quantity" value="1">
                    <button type="submit" class="action-btn" @disabled((int) $product->quantity <= 0)><i class="fas fa-shopping-bag"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="product-details">
        <h3 class="product-name">
            <a href="{{ route('product.detail', $product->product_id) }}" class="product-link">{{ $product->name }}</a>
        </h3>
        <div class="price-wrapper">
            <span class="current-price">{{ number_format($product->sale_price, 0, ',', '.') }}đ</span>
            @if($product->price > $product->sale_price)
                <span class="original-price">{{ number_format($product->price, 0, ',', '.') }}đ</span>
            @endif
        </div>
        @if((int) $product->quantity > 0)
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <input type="hidden" name="product_quantity" value="1">
                <input type="hidden" name="buy_now" value="1">
                <button type="submit" class="buy-now-btn"><i class="fas fa-shopping-cart"></i> Mua ngay</button>
            </form>
        @else
            <button type="button" class="buy-now-btn" disabled><i class="fas fa-ban"></i> Hết hàng</button>
        @endif
    </div>
</div>
