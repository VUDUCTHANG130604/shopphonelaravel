@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Bài viết')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@section('content')
<div class="blog-breadcrumb">
    <div class="container-wrapper">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-link"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ isset($category) ? $category->name : 'Tin tức & Đánh giá' }}</span>
        </div>
    </div>
</div>

<div class="blog-section">
    <div class="container-wrapper">
        <div class="page-header">
            <h1 class="page-title">Tin tức công nghệ</h1>
            <p class="page-description">Cập nhật tin tức mới nhất về điện thoại và công nghệ</p>
        </div>

        <div class="blog-layout">
            <aside class="blog-sidebar">
                <div class="sidebar-sticky">
                    <div class="sidebar-widget">
                        <div class="widget-header"><i class="fas fa-th-large"></i><h4 class="widget-title">Danh mục</h4></div>
                        <ul class="category-list">
                            <li><a href="{{ route('blog.index') }}" class="category-link {{ !isset($category) ? 'active' : '' }}"><span class="link-text"><i class="fas fa-angle-right"></i>Tất cả bài viết</span></a></li>
                            @foreach($categories as $item)
                                <li>
                                    <a href="{{ route('blog.category', $item->id) }}" class="category-link {{ isset($category) && $category->id === $item->id ? 'active' : '' }}">
                                        <span class="link-text"><i class="fas fa-angle-right"></i>{{ $item->name }}</span>
                                        <span class="post-count">{{ $item->posts_count }}</span>
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

            <div class="blog-main">
                <div class="posts-grid">
                    @forelse($posts as $post)
                        <article class="post-card">
                            <a href="{{ route('blog.show', $post->post_id) }}" class="post-image-wrapper">
                                <img src="{{ asset('upload/'.$post->image) }}" alt="{{ $post->title }}" class="post-image">
                                <div class="image-overlay"><span class="overlay-icon"><i class="fas fa-arrow-right"></i></span></div>
                            </a>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="meta-item"><i class="fas fa-user-circle"></i>{{ $post->author }}</span>
                                    <span class="meta-item"><i class="far fa-calendar-alt"></i>{{ optional($post->created_at)->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="post-title"><a href="{{ route('blog.show', $post->post_id) }}">{{ $post->title }}</a></h3>
                                <a href="{{ route('blog.show', $post->post_id) }}" class="read-more-btn">Xem chi tiết<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </article>
                    @empty
                        <p>Chưa có bài viết.</p>
                    @endforelse
                </div>
                <div>{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
