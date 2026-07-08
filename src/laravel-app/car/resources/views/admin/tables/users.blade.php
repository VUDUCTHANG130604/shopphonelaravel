@extends('layouts.admin')

@section('title', 'Thành viên')

@push('styles')
<style>
.users-wrapper{background:#f8fafc;min-height:100vh;padding:32px 20px}
.users-container{max-width:1400px;margin:0 auto}
.users-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:20px}
.page-title{font-size:28px;font-weight:700;color:#0f172a;margin-bottom:6px}
.page-subtitle{font-size:15px;color:#64748b;font-weight:400}
.btn-add{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:#3b82f6;color:#fff;border-radius:8px;font-size:14px;font-weight:500;text-decoration:none;transition:all .2s}
.btn-add:hover{background:#2563eb;color:#fff;transform:translateY(-1px);box-shadow:0 4px 12px rgba(59,130,246,.3)}
.table-wrapper{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);padding:10px}
.users-table{width:100%;border-collapse:collapse}
.users-table thead{background:#f8fafc;border-bottom:1px solid #e2e8f0}
.users-table thead th{padding:16px 20px;text-align:left;font-size:13px;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:.5px}
.table-row{border-bottom:1px solid #f1f5f9;transition:background .15s}
.table-row:hover{background:#f8fafc}
.users-table tbody td{padding:16px 20px;vertical-align:middle}
.td-id{font-size:14px;font-weight:600;color:#64748b}
.avatar-wrapper{width:48px;height:48px;border-radius:50%;overflow:hidden;border:2px solid #e2e8f0}
.user-avatar{width:100%;height:100%;object-fit:cover;display:block}
.user-name{font-size:14px;font-weight:600;color:#1e293b}
.email-cell,.phone-cell{display:flex;align-items:center;gap:8px;font-size:14px;color:#475569}
.email-cell i,.phone-cell i{width:16px;color:#94a3b8;flex-shrink:0}
.role-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:6px;font-size:13px;font-weight:500;border:1px solid}
.role-customer{background:#f0f9ff;color:#0369a1;border-color:#bae6fd}
.role-staff{background:#fefce8;color:#a16207;border-color:#fef08a}
.user-actions{display:flex;gap:6px;white-space:nowrap}
@media(max-width:1200px){.users-table{min-width:1000px}.table-wrapper{overflow-x:auto}}
@media(max-width:768px){.users-wrapper{padding:20px 16px}.page-title{font-size:24px}.users-header{flex-direction:column;align-items:stretch}.btn-add{justify-content:center}}
</style>
@endpush

@section('content')
<div class="users-wrapper">
    <div class="users-container">
        <div class="users-header">
            <div>
                <h1 class="page-title">Danh sách tài khoản</h1>
                <p class="page-subtitle">Quản lý người dùng trong hệ thống</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-add"><i class="fa fa-plus"></i><span>Thêm tài khoản</span></a>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

        <div class="table-wrapper">
            <table class="users-table" id="users-list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $user)
                        <tr class="table-row">
                            <td class="td-id">{{ $loop->iteration }}</td>
                            <td>
                                <div class="avatar-wrapper">
                                    <img src="{{ asset('upload/'.($user->image ?: 'user-default.png')) }}" alt="{{ $user->full_name ?: $user->name }}" class="user-avatar">
                                </div>
                            </td>
                            <td><span class="user-name">{{ $user->full_name ?: $user->name ?: $user->username }}</span></td>
                            <td><div class="email-cell"><i class="fa fa-envelope"></i><span>{{ $user->email }}</span></div></td>
                            <td><div class="phone-cell"><i class="fa fa-phone"></i><span>{{ $user->phone }}</span></div></td>
                            <td>
                                <span class="role-badge {{ (int) $user->role === 1 ? 'role-staff' : 'role-customer' }}">
                                    <i class="fa {{ (int) $user->role === 1 ? 'fa-briefcase' : 'fa-user' }}"></i>
                                    <span>{{ (int) $user->role === 1 ? 'Nhân viên' : 'Khách hàng' }}</span>
                                </span>
                            </td>
                            <td>{{ $user->active ? 'Hoạt động' : 'Khóa' }}</td>
                            <td>
                                <div class="user-actions">
                                    <form method="post" action="{{ route('admin.users.toggle', $user->user_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-secondary">{{ $user->active ? 'Khóa' : 'Mở' }}</button>
                                    </form>
                                    <form method="post" action="{{ route('admin.users.destroy', $user->user_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa tài khoản này?')">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
