@extends('layouts.admin')

@section('title', 'Bình luận')

@push('styles')
<style>
.comments-wrapper{padding:2rem 1.5rem;max-width:1400px;margin:0 auto}
.comments-card{background:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1);overflow:hidden;border:1px solid #f1f1f1}
.comments-card .card-header{padding:1.25rem 1.5rem;border-bottom:1px solid #fde2e7;background:#fff7f8}
.comments-card .card-header h6{margin:0;font-size:1.125rem;font-weight:700;color:#991b1b}
.table-container{overflow-x:auto;padding:1.5rem}
.comments-table{width:100%;border-collapse:collapse;font-size:.875rem;min-width:980px}
.comments-table thead{background:#fff5f6;border-bottom:2px solid #fde2e7}
.comments-table th{padding:.75rem 1rem;text-align:left;font-weight:700;color:#991b1b;font-size:.8125rem;text-transform:uppercase;letter-spacing:.025em;white-space:nowrap}
.comments-table tbody tr{border-bottom:1px solid #f3f4f6;transition:background-color .15s}
.comments-table tbody tr:hover{background:#fff7f8}
.comments-table td{padding:1rem;color:#4b5563;vertical-align:top}
.td-name{font-weight:600;color:#111827;white-space:nowrap}
.td-content{max-width:450px;line-height:1.5;color:#374151}
.td-date{color:#6b7280;font-size:.8125rem;white-space:nowrap}
.comment-status{display:inline-block;padding:5px 10px;border-radius:999px;font-weight:700;font-size:12px}
.comment-status.show{background:#dcfce7;color:#166534}
.comment-status.hide{background:#fee2e2;color:#991b1b}
.comment-actions{display:flex;align-items:center;gap:6px;white-space:nowrap}
.comment-actions form{margin:0}
.btn-comment{display:inline-flex;align-items:center;justify-content:center;min-height:34px;padding:.45rem .8rem;color:#fff;text-decoration:none;border-radius:6px;font-size:.8125rem;font-weight:700;border:0;cursor:pointer;line-height:1}
.btn-comment:hover{color:#fff}
.btn-comment.detail{background:#dc2626}
.btn-comment.detail:hover{background:#b91c1c}
.btn-comment.toggle{background:#6b7280}
.btn-comment.toggle:hover{background:#4b5563}
.btn-comment.delete{background:#fff;color:#dc2626;border:1px solid #fecaca}
.btn-comment.delete:hover{background:#fee2e2;color:#991b1b}
@media(max-width:768px){.comments-wrapper{padding:1rem}.comments-card .card-header{padding:1rem}.table-container{padding:1rem}.td-content{max-width:260px}}
</style>
@endpush

@section('content')
<div class="comments-wrapper">
    <div class="comments-card">
        <div class="card-header"><h6>Danh sách bình luận</h6></div>

        <div class="table-container">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <table class="comments-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Sản phẩm</th>
                        <th>Bình luận</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $comment)
                        <tr>
                            <td>{{ ($rows->currentPage() - 1) * $rows->perPage() + $loop->iteration }}</td>
                            <td class="td-name">{{ $comment->full_name ?: $comment->name ?: 'Khách hàng' }}</td>
                            <td>{{ $comment->product_name }}</td>
                            <td class="td-content">{{ $comment->content }}</td>
                            <td class="td-date">{{ optional($comment->date ? \Carbon\Carbon::parse($comment->date) : null)->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="comment-status {{ $comment->status ? 'show' : 'hide' }}">
                                    {{ $comment->status ? 'Hiện' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>
                                <div class="comment-actions">
                                    <a href="{{ route('admin.comments.show', $comment->comment_id) }}" class="btn-comment detail">Chi tiết</a>
                                    <form method="post" action="{{ route('admin.comments.toggle', $comment->comment_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn-comment toggle" type="submit">{{ $comment->status ? 'Ẩn' : 'Hiện' }}</button>
                                    </form>
                                    <form method="post" action="{{ route('admin.comments.destroy', $comment->comment_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-comment delete" type="submit" onclick="return confirm('Xóa bình luận này?')">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">Chưa có bình luận.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $rows->links() }}
        </div>
    </div>
</div>
@endsection
