<style>
.site-header-scope, .site-header-scope * { box-sizing: border-box; }
.breadcrumb-option { padding: 10px !important; }
.top-header { background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%); color: #fff; padding: 12px 0; }
.top-header-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; gap: 30px; }
.logo { display: flex; align-items: center; gap: 10px; text-decoration: none; color: #fff; white-space: nowrap; }
.logo:hover { color: #fff; text-decoration: none; }
.logo-icon { width: 40px; height: 40px; background: #fff; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #dc2626; font-weight: 700; }
.logo-text { font-size: 20px; font-weight: 700; }
.store-info { display: flex; flex-direction: column; padding-left: 20px; border-left: 1px solid rgba(255,255,255,.3); }
.store-info-line { font-size: 13px; line-height: 1.5; }
.store-info-highlight { font-weight: 600; }
.search-wrapper { flex: 1; max-width: 600px; }
.search-form { position: relative; width: 100%; }
.search-input { width: 100%; padding: 12px 50px 12px 20px; border: 0; border-radius: 25px; font-size: 14px; outline: 0; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
.search-btn { position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: #dc2626; color: #fff; border: 0; width: 38px; height: 38px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; }
.search-btn:hover { background: #b91c1c; }
.top-header-actions { display: flex; align-items: center; gap: 25px; margin-left: auto; }
.header-link { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #fff; font-size: 12px; transition: opacity .2s; white-space: nowrap; background: transparent; border: 0; cursor: pointer; }
.header-link:hover { opacity: .8; color: #fff; text-decoration: none; }
.header-link i { font-size: 20px; margin-bottom: 4px; }
.hotline-link { display: flex; align-items: center; gap: 10px; text-decoration: none; color: #fff; transition: opacity .2s; }
.hotline-link:hover { opacity: .8; color: #fff; text-decoration: none; }
.hotline-icon { font-size: 24px; }
.hotline-info { display: flex; flex-direction: column; }
.hotline-label { font-size: 12px; opacity: .9; }
.hotline-number { font-size: 15px; font-weight: 700; }
.cart-link { position: relative; }
.cart-badge { position: absolute; top: -8px; right: -10px; background: #fbbf24; color: #dc2626; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 10px; min-width: 18px; text-align: center; }
.account-dropdown { position: relative; }
.account-toggle span { max-width: 92px; overflow: hidden; text-overflow: ellipsis; }
.account-menu { position: absolute; right: 0; top: calc(100% + 10px); min-width: 190px; background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 14px 30px rgba(0,0,0,.16); padding: 8px 0; z-index: 1000; display: none; }
.account-dropdown:hover .account-menu, .account-dropdown:focus-within .account-menu { display: block; }
.account-menu::before { content: ''; position: absolute; top: -10px; right: 18px; border-left: 8px solid transparent; border-right: 8px solid transparent; border-bottom: 10px solid #fff; }
.account-menu a, .account-menu button { width: 100%; display: flex; align-items: center; gap: 10px; padding: 10px 14px; color: #374151; background: #fff; border: 0; text-decoration: none; font-size: 14px; text-align: left; cursor: pointer; }
.account-menu a:hover, .account-menu button:hover { background: #fef2f2; color: #dc2626; text-decoration: none; }
.account-menu i { width: 16px; text-align: center; color: #dc2626; }
.bottom-nav { background: #fff; border-bottom: 2px solid #e5e7eb; box-shadow: 0 2px 4px rgba(0,0,0,.05); }
.bottom-nav-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; gap: 5px; overflow-x: auto; }
.bottom-nav .nav-link { padding: 14px 18px; color: #374151; text-decoration: none; font-size: 14px; font-weight: 500; white-space: nowrap; transition: all .2s; border-radius: 6px; }
.bottom-nav .nav-link:hover { background: #fef2f2; color: #dc2626; }
@media (max-width: 1200px) { .store-info { display: none; } .search-wrapper { max-width: 400px; } }
@media (max-width: 968px) { .hotline-link, .header-link:not(.cart-link):not(.account-toggle) { display: none; } .bottom-nav-container { scrollbar-width: none; } .bottom-nav-container::-webkit-scrollbar { display: none; } }
@media (max-width: 640px) { .top-header-container { gap: 15px; } .logo-text { display: none; } .search-wrapper { flex: 1; max-width: none; } .account-toggle span { display: none; } }
</style>

@php
    $cartCount = auth()->check()
        ? \App\Models\Cart::where('user_id', auth()->user()->user_id)->sum('product_quantity')
        : collect(session('cart', []))->sum('quantity');
    $displayName = auth()->check()
        ? (auth()->user()->full_name ?: auth()->user()->name ?: auth()->user()->username)
        : null;
@endphp

<div class="site-header-scope">
<div class="top-header">
    <div class="top-header-container">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">T</div>
            <span class="logo-text">THANG MOBILE</span>
        </a>

        <div class="store-info">
            <div class="store-info-line">Hệ thống cửa hàng</div>
            <div class="store-info-line"><span class="store-info-highlight">(45 chi nhánh)</span></div>
        </div>

        <div class="search-wrapper">
            <form class="search-form" action="{{ route('shop.search') }}" method="get">
                <input type="search" name="query" class="search-input" placeholder="Bạn tìm gì hôm nay?" value="{{ request('query') }}">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="top-header-actions">
            <a href="{{ route('blog.index') }}" class="header-link"><i class="fas fa-cog"></i><span>24h Công nghệ</span></a>
            <a href="{{ route('contact') }}" class="header-link"><i class="fas fa-phone"></i><span>Liên hệ</span></a>
            <a href="tel:1900636099" class="hotline-link">
                <i class="fas fa-phone-alt hotline-icon"></i>
                <div class="hotline-info">
                    <span class="hotline-label">Hotline</span>
                    <span class="hotline-number">0123 456 789</span>
                </div>
            </a>

            @auth
                <div class="account-dropdown">
                    <button type="button" class="header-link account-toggle">
                        <i class="far fa-user"></i>
                        <span>{{ $displayName }}</span>
                    </button>
                    <div class="account-menu">
                        <a href="{{ route('account.show') }}"><i class="fa fa-user"></i>Hồ sơ</a>
                        <a href="{{ route('orders.index') }}"><i class="fa fa-shopping-bag"></i>Đơn mua</a>
                        <a href="{{ route('account.address') }}"><i class="fa fa-map-marker"></i>Địa chỉ</a>
                        <a href="{{ route('account.password') }}"><i class="fa fa-lock"></i>Đổi mật khẩu</a>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"><i class="fa fa-sign-out-alt"></i>Đăng xuất</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="header-link"><i class="far fa-user"></i><span>Đăng nhập</span></a>
            @endauth

            <a href="{{ route('cart.index') }}" class="header-link cart-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Giỏ hàng</span>
                <span class="cart-badge">{{ $cartCount }}</span>
            </a>
        </div>
    </div>
</div>

<nav class="bottom-nav">
    <div class="bottom-nav-container">
        <a href="{{ route('shop.legacy') }}" class="nav-link">Shop</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Iphone</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Loa, tai nghe</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Phụ kiện</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Tablet</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Đồng hồ</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Vertu</a>
        <a href="{{ route('shop.legacy') }}" class="nav-link">Khác</a>
    </div>
</nav>
</div>
