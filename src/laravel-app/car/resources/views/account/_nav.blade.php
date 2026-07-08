<div class="profile-sidebar">
    <div class="profile-header">
        <img src="{{ asset('upload/'.(Auth::user()->image ?: 'user-default.png')) }}" alt="avatar" class="profile-avatar">
        <div class="profile-info">
            <h6 class="profile-name">{{ Auth::user()->full_name ?? Auth::user()->name }}</h6>
            <a href="{{ route('account.edit') }}" class="profile-edit">Sửa hồ sơ</a>
        </div>
    </div>

    <div class="profile-menu">
        <a href="{{ route('account.show') }}" class="menu-item {{ request()->routeIs('account.show') || request()->routeIs('account.edit') ? 'active' : '' }}">
            <i class="fa fa-user"></i><span>Hồ sơ</span>
        </a>
        <a href="{{ route('orders.index') }}" class="menu-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="fa fa-shopping-bag"></i><span>Đơn mua</span>
        </a>
        <a href="{{ route('account.address') }}" class="menu-item {{ request()->routeIs('account.address') ? 'active' : '' }}">
            <i class="fa fa-map-marker"></i><span>Địa chỉ</span>
        </a>
        <a href="{{ route('account.password') }}" class="menu-item {{ request()->routeIs('account.password') ? 'active' : '' }}">
            <i class="fa fa-lock"></i><span>Đổi mật khẩu</span>
        </a>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="menu-item w-100 border-0 bg-transparent text-left" type="submit">
                <i class="fa fa-sign-out-alt"></i><span>Đăng xuất</span>
            </button>
        </form>
    </div>
</div>
