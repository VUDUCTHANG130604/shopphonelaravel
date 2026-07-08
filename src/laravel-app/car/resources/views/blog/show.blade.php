@extends('layouts.app')

@section('title', $post->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog-detail.css') }}">
@endpush

@section('content')
<div class="blog-breadcrumb">
    <div class="container-wrapper">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('blog.index') }}" class="breadcrumb-link">Tin tức & Đánh giá</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $post->title }}</span>
        </div>
    </div>
</div>

<div class="blog-detail-section">
    <div class="container-wrapper">
        <div class="blog-layout">
            <aside class="blog-sidebar">
                <div class="sidebar-sticky">
                    <div class="sidebar-widget">
                        <div class="widget-header"><i class="fas fa-th-large"></i><h4 class="widget-title">Danh mục</h4></div>
                        <ul class="category-list">
                            <li><a href="{{ route('blog.index') }}" class="category-link"><span class="link-text"><i class="fas fa-angle-right"></i>Tất cả bài viết</span></a></li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.category', $category->id) }}" class="category-link {{ (int) $post->category_id === (int) $category->id ? 'active' : '' }}">
                                        <span class="link-text"><i class="fas fa-angle-right"></i>{{ $category->name }}</span>
                                        <span class="post-count">{{ $category->posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-widget">
                        <div class="widget-header"><i class="fas fa-bolt"></i><h4 class="widget-title">Bài viết nổi bật</h4></div>
                        <div class="recent-posts">
                            @foreach($recentPosts as $recent)
                                <a href="{{ route('blog.show', $recent->post_id) }}" class="recent-post-item">
                                    <div class="recent-post-image">
                                        <img src="{{ asset('upload/'.$recent->image) }}" alt="{{ $recent->title }}">
                                        <div class="image-badge"><i class="fas fa-star"></i></div>
                                    </div>
                                    <div class="recent-post-content">
                                        <h5 class="recent-post-title">{{ $recent->title }}</h5>
                                        <span class="recent-post-date"><i class="far fa-calendar"></i>{{ optional($recent->created_at)->format('d/m/Y') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            <article class="blog-main-detail">
                <div class="detail-card">
                    <div class="detail-header">
                        <div class="header-top">
                            <span class="category-badge"><i class="fas fa-bookmark"></i>{{ $post->category->name ?? 'Bài viết' }}</span>
                        </div>
                        <h1 class="detail-title">{{ $post->title }}</h1>
                        <div class="detail-meta">
                            <div class="meta-item"><i class="fas fa-user-circle"></i><span>{{ $post->author }}</span></div>
                            <span class="meta-divider">|</span>
                            <div class="meta-item"><i class="far fa-calendar-alt"></i><span>{{ optional($post->created_at)->format('d/m/Y') }}</span></div>
                            <span class="meta-divider">|</span>
                            <div class="meta-item"><i class="far fa-eye"></i><span>1,234 lượt xem</span></div>
                        </div>
                    </div>

                    @if($post->image)
                        <div class="featured-image-wrapper">
                            <img src="{{ asset('upload/'.$post->image) }}" alt="{{ $post->title }}" class="featured-image">
                        </div>
                    @endif

                    <div class="detail-content">{!! $post->content !!}</div>

                    <div class="detail-tags">
                        <div class="tags-label"><i class="fas fa-tags"></i><span>Tags:</span></div>
                        <div class="tags-list">
                            <a href="#" class="tag-item">Điện thoại</a>
                            <a href="#" class="tag-item">Smartphone</a>
                            <a href="#" class="tag-item">Review</a>
                            <a href="#" class="tag-item">Công nghệ</a>
                        </div>
                    </div>

                    <div class="detail-share">
                        <h5 class="share-title"><i class="fas fa-share-alt"></i>Chia sẻ bài viết</h5>
                        <div class="share-buttons">
                            <a href="#" class="share-btn share-facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="share-btn share-twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="share-btn share-linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="share-btn share-zalo"><i class="fas fa-comment-dots"></i></a>
                        </div>
                    </div>
                </div>

                <div class="back-button-wrapper">
                    <a href="{{ route('blog.index') }}" class="back-button"><i class="fas fa-arrow-left"></i>Quay lại danh sách</a>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection
