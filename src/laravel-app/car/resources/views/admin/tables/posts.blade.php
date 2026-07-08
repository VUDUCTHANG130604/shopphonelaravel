@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
<div class="posts-wrapper">
    <div class="posts-container">
        <div class="posts-header">
            <div class="header-content">
                <h1 class="page-title">Danh sách bài viết</h1>
                <p class="page-subtitle">Quản lý tất cả bài viết của bạn</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="btn-add">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Thêm bài viết</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success-old">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($rows->count() > 0)
            <div class="table-wrapper">
                <table class="posts-table">
                    <thead>
                        <tr>
                            <th class="th-id">#</th>
                            <th class="th-title">Tiêu đề</th>
                            <th class="th-author">Tác giả</th>
                            <th class="th-category">Chuyên mục</th>
                            <th class="th-actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $post)
                            <tr class="table-row">
                                <td class="td-id">{{ $loop->iteration + ($rows->currentPage() - 1) * $rows->perPage() }}</td>
                                <td class="td-title">
                                    <div class="title-cell">{{ $post->title }}</div>
                                </td>
                                <td class="td-author">
                                    <div class="author-cell">
                                        <svg class="author-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span>{{ $post->author }}</span>
                                    </div>
                                </td>
                                <td class="td-category">
                                    <span class="category-badge">{{ $post->category->name ?? 'Chưa phân loại' }}</span>
                                </td>
                                <td class="td-actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.posts.edit', $post->post_id) }}" class="btn-action btn-view" title="Xem chi tiết">
                                            <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post->post_id) }}" class="btn-action btn-edit" title="Chỉnh sửa">
                                            <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="post" action="{{ route('admin.posts.destroy', $post->post_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-action btn-delete" onclick="return confirm('Bạn có chắc muốn xóa?\nSau khi xóa sẽ không thể khôi phục')" title="Xóa">
                                                <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $rows->links() }}</div>
        @else
            <div class="empty-state">
                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <h3 class="empty-title">Chưa có bài viết nào</h3>
                <p class="empty-text">Bắt đầu tạo bài viết đầu tiên của bạn</p>
                <a href="{{ route('admin.posts.create') }}" class="btn-create">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tạo bài viết mới</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.posts-wrapper{background:#f8fafc;min-height:100vh;padding:32px 20px}.posts-container{max-width:1400px;margin:0 auto}.posts-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:20px}.header-content{flex:1}.page-title{font-size:28px;font-weight:700;color:#0f172a;margin-bottom:6px}.page-subtitle{font-size:15px;color:#64748b;font-weight:400}.btn-add{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:#3b82f6;color:#fff;border-radius:8px;font-size:14px;font-weight:500;text-decoration:none;transition:all .2s;border:0}.btn-add:hover{background:#2563eb;color:#fff;transform:translateY(-1px);box-shadow:0 4px 12px rgba(59,130,246,.3)}.btn-icon{width:18px;height:18px}.alert-success-old{display:flex;align-items:center;gap:12px;padding:14px 18px;background:#f0fdf4;border:1px solid #86efac;border-radius:10px;margin-bottom:24px;color:#15803d;font-size:14px;font-weight:500}.alert-icon{width:20px;height:20px;color:#22c55e;flex-shrink:0}.table-wrapper{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08)}.posts-table{width:100%;border-collapse:collapse}.posts-table thead{background:#f8fafc;border-bottom:1px solid #e2e8f0}.posts-table thead th{padding:16px 20px;text-align:left;font-size:13px;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:.5px}.th-id{width:60px}.th-title{min-width:250px}.th-author{width:180px}.th-category{width:160px}.th-actions{width:150px;text-align:center}.table-row{border-bottom:1px solid #f1f5f9;transition:background .15s}.table-row:hover{background:#f8fafc}.table-row:last-child{border-bottom:0}.posts-table tbody td{padding:18px 20px;vertical-align:middle}.td-id{font-size:14px;font-weight:600;color:#64748b}.title-cell{font-size:14px;font-weight:500;color:#1e293b;line-height:1.5}.author-cell{display:flex;align-items:center;gap:8px;font-size:14px;color:#475569}.author-icon{width:16px;height:16px;color:#94a3b8;flex-shrink:0}.category-badge{display:inline-block;padding:5px 12px;background:#eff6ff;color:#1e40af;border-radius:6px;font-size:13px;font-weight:500;border:1px solid #dbeafe}.action-buttons{display:flex;gap:6px;justify-content:center}.action-buttons form{margin:0}.btn-action{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;transition:all .2s;border:1px solid;text-decoration:none;background:#fff}.action-icon{width:18px;height:18px}.btn-view{border-color:#e2e8f0;color:#0ea5e9}.btn-view:hover{background:#0ea5e9;border-color:#0ea5e9;color:#fff}.btn-edit{border-color:#e2e8f0;color:#f59e0b}.btn-edit:hover{background:#f59e0b;border-color:#f59e0b;color:#fff}.btn-delete{border-color:#e2e8f0;color:#ef4444}.btn-delete:hover{background:#ef4444;border-color:#ef4444;color:#fff}.empty-state{background:#fff;border-radius:12px;padding:80px 40px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08)}.empty-icon{width:80px;height:80px;color:#cbd5e1;margin:0 auto 24px}.empty-title{font-size:20px;font-weight:600;color:#1e293b;margin-bottom:8px}.empty-text{font-size:15px;color:#64748b;margin-bottom:28px}.btn-create{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:#3b82f6;color:#fff;border-radius:8px;font-size:15px;font-weight:500;text-decoration:none;transition:all .2s}.btn-create:hover{background:#2563eb;color:#fff;transform:translateY(-2px);box-shadow:0 8px 16px rgba(59,130,246,.3)}@media(max-width:1200px){.posts-table{min-width:900px}.table-wrapper{overflow-x:auto}}@media(max-width:768px){.posts-wrapper{padding:20px 16px}.page-title{font-size:24px}.page-subtitle{font-size:14px}.posts-header{flex-direction:column;align-items:stretch}.btn-add{justify-content:center}.empty-state{padding:60px 24px}}@media(max-width:576px){.posts-wrapper{padding:16px 12px}.page-title{font-size:20px}.posts-table thead th,.posts-table tbody td{padding:12px 10px;font-size:12px}.action-buttons{gap:4px}.btn-action{width:32px;height:32px}.action-icon{width:16px;height:16px}}
</style>
@endsection
