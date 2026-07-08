@extends('layouts.admin')

@section('title', 'Chi tiết bình luận')

@push('styles')
<style>
.comment-detail-wrapper{padding:2rem 1.5rem;max-width:1200px;margin:0 auto}
.detail-card{background:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1);overflow:hidden}
.detail-header{padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb}
.detail-header h6{margin:0;font-size:.9375rem;font-weight:500;color:#6b7280}
.breadcrumb-link{color:#dc2626;text-decoration:none}
.breadcrumb-link:hover{color:#b91c1c}
.detail-section{padding:1.5rem}
.section-title{font-size:.9375rem;font-weight:600;color:#111827;margin-bottom:.75rem}
.content-box{border:1px solid #e5e7eb;border-radius:6px;padding:1.25rem;background:#fff;min-height:100px}
.content-text{color:#374151;line-height:1.6;margin:0}
.grid-2col{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-top:1.5rem}
.info-card{border:1px solid #e5e7eb;border-radius:6px;padding:1.5rem;background:#fff}
.status-badge{display:inline-block;padding:.25rem .625rem;border-radius:4px;font-size:.8125rem;font-weight:500}
.status-hidden{background:#fef3c7;color:#92400e}
.status-visible{background:#d1fae5;color:#065f46}
.form-group{margin-bottom:1rem}
.form-select{width:100%;padding:.625rem .75rem;border:1px solid #d1d5db;border-radius:6px;font-size:.875rem;color:#374151;background:#fff}
.form-select:focus{outline:none;border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.12)}
.button-group{display:flex;gap:.75rem;margin-top:1.25rem}
.btn-old{padding:.625rem 1.25rem;border:0;border-radius:6px;font-size:.875rem;font-weight:500;cursor:pointer;text-decoration:none;display:inline-block}
.btn-primary-old{background:#dc2626;color:#fff}
.btn-primary-old:hover{background:#b91c1c;color:#fff}
.btn-danger-old{background:#ef4444;color:#fff}
.btn-danger-old:hover{background:#dc2626;color:#fff}
.info-row{display:flex;padding:.75rem 0;border-bottom:1px solid #f3f4f6}
.info-row:last-child{border-bottom:0}
.info-label{flex:0 0 140px;font-size:.875rem;font-weight:500;color:#6b7280}
.info-value{flex:1;font-size:.875rem;color:#111827}
.info-value.highlight{color:#dc2626;font-weight:500}
@media(max-width:768px){.comment-detail-wrapper{padding:1rem}.grid-2col{grid-template-columns:1fr}.button-group{flex-direction:column}.btn-old{width:100%;text-align:center}}
</style>
@endpush

@section('content')
@php
    $statusText = $comment->status ? 'Hiển thị' : 'Tạm ẩn';
    $statusClass = $comment->status ? 'status-visible' : 'status-hidden';
    $customerName = $comment->user?->full_name ?: $comment->user?->name ?: 'Khách hàng';
@endphp

<div class="comment-detail-wrapper">
    <article class="detail-card">
        <header class="detail-header">
            <h6>
                <a href="{{ route('admin.comments') }}" class="breadcrumb-link">Bình luận</a>
                / Chi tiết bình luận
            </h6>
        </header>

        @if(session('success'))<div class="alert alert-success m-3">{{ session('success') }}</div>@endif

        <div class="detail-section">
            <h6 class="section-title">Nội dung bình luận</h6>
            <div class="content-box">
                <p class="content-text">{{ $comment->content }}</p>
            </div>
        </div>

        <div class="detail-section">
            <div class="grid-2col">
                <div class="info-card">
                    <h6 class="section-title">
                        Trạng thái: <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                    </h6>

                    <form method="post" action="{{ route('admin.comments.toggle', $comment->comment_id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-select" disabled>
                                <option>{{ $statusText }}</option>
                            </select>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-old btn-primary-old">
                                {{ $comment->status ? 'Tạm ẩn' : 'Hiển thị' }}
                            </button>
                        </div>
                    </form>

                    <form method="post" action="{{ route('admin.comments.destroy', $comment->comment_id) }}" class="button-group">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-old btn-danger-old" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận? Sau khi xóa sẽ không thể khôi phục!')">
                            Xóa bình luận
                        </button>
                    </form>
                </div>

                <div class="info-card">
                    <div class="info-row">
                        <div class="info-label">Tên sản phẩm</div>
                        <div class="info-value highlight">{{ $comment->product?->name ?: 'Không xác định' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Họ tên</div>
                        <div class="info-value">{{ $customerName }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Thời gian</div>
                        <div class="info-value">{{ optional($comment->date)->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection
