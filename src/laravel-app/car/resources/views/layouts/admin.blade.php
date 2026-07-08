<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin') - Quản lý</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="{{ asset('admin/img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: "Heebo", sans-serif;
        }

        .fa-bars {
            color: #dc2626;
        }

        .sidebar,
        .sidebar .navbar {
            background: #1a0a0d !important;
        }

        .sidebar .navbar .navbar-nav .nav-link i,
        .admin-logout i {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border-radius: 40px;
        }

        .sidebar .navbar-brand h3 {
            color: #ffffff !important;
            white-space: nowrap;
        }

        .sidebar .navbar .navbar-nav .nav-link,
        .sidebar .navbar .navbar-nav .dropdown-toggle,
        .admin-logout {
            color: #ffe0e6 !important;
        }

        .sidebar .navbar .navbar-nav .nav-link.active,
        .sidebar .navbar .navbar-nav .nav-link:hover,
        .admin-logout:hover {
            color: #ffffff !important;
            background: #dc2626 !important;
            border-left: 3px solid #dc2626 !important;
        }

        .sidebar .navbar .navbar-nav .nav-link:hover i,
        .sidebar .navbar .navbar-nav .nav-link.active i,
        .admin-logout:hover i {
            background: #dc2626 !important;
        }

        .sidebar .navbar .navbar-nav .dropdown-toggle:hover {
            color: #ffffff !important;
            background: #2d0a12 !important;
        }

        .sidebar .dropdown-menu {
            background: #2d0a12 !important;
        }

        .sidebar .dropdown-item {
            color: #ffc8d4 !important;
        }

        .sidebar .dropdown-item:hover,
        .sidebar .dropdown-item.active {
            color: #ffffff !important;
            background: #dc2626 !important;
        }

        .admin-logout {
            width: 100%;
            text-align: left;
            border: 0;
            background: transparent;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand mx-4 mb-3">
                    <h3>THANG MOBILE</h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer-alt me-2"></i>Tổng quan
                    </a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            <i class="fa fa-shopping-basket me-2"></i>Đơn hàng
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.orders') }}" class="dropdown-item {{ request()->routeIs('admin.orders') && !request('status') ? 'active' : '' }}">Tất cả đơn</a>
                            <a href="{{ route('admin.orders.pending') }}" class="dropdown-item {{ request('status') == 1 ? 'active' : '' }}">Đơn chờ xác nhận</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            <i class="fa fa-th me-2"></i>Danh mục
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.categories.create') }}" class="dropdown-item {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">Thêm mới</a>
                            <a href="{{ route('admin.categories') }}" class="dropdown-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}">Tất cả</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.products*') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            <i class="fas fa-box me-2"></i>Sản phẩm
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.products.create') }}" class="dropdown-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">Thêm mới</a>
                            <a href="{{ route('admin.products') }}" class="dropdown-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">Tất cả</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.posts*') || request()->routeIs('admin.post-categories*') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            <i class="fas fa-book me-2"></i>Bài viết
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.posts') }}" class="dropdown-item {{ request()->routeIs('admin.posts') ? 'active' : '' }}">Tất cả</a>
                            <a href="{{ route('admin.posts.create') }}" class="dropdown-item {{ request()->routeIs('admin.posts.create') ? 'active' : '' }}">Thêm bài viết</a>
                            <a href="{{ route('admin.post-categories') }}" class="dropdown-item {{ request()->routeIs('admin.post-categories') ? 'active' : '' }}">Chuyên mục</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('admin.stats*') ? 'active' : '' }}" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-2"></i>Báo cáo
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('admin.stats.products') }}" class="dropdown-item {{ request()->routeIs('admin.stats.products') ? 'active' : '' }}">Sản phẩm - danh mục</a>
                            <a href="{{ route('admin.stats.orders') }}" class="dropdown-item {{ request()->routeIs('admin.stats.orders') ? 'active' : '' }}">Đơn hàng</a>
                            <a href="{{ route('admin.stats.chart') }}" class="dropdown-item {{ request()->routeIs('admin.stats.chart') ? 'active' : '' }}">Biểu đồ lượt bán</a>
                            <a href="{{ route('admin.stats.top') }}" class="dropdown-item {{ request()->routeIs('admin.stats.top') ? 'active' : '' }}">Top lượt bán</a>
                            <a href="{{ route('admin.stats.days') }}" class="dropdown-item {{ request()->routeIs('admin.stats.days') ? 'active' : '' }}">Lượt bán theo ngày</a>
                        </div>
                    </div>

                    <a href="{{ route('admin.warehouse') }}" class="nav-item nav-link {{ request()->routeIs('admin.warehouse*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse me-2"></i>Quản lý kho
                    </a>
                    <a href="{{ route('admin.users') }}" class="nav-item nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i>Thành viên
                    </a>
                    <a href="{{ route('admin.comments') }}" class="nav-item nav-link {{ request()->routeIs('admin.comments*') ? 'active' : '' }}">
                        <i class="fas fa-comment me-2"></i>Bình luận
                    </a>

                    <form method="post" action="{{ route('admin.logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="nav-item nav-link admin-logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');">
                            <i class="fas fa-user me-2"></i>Đăng xuất
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4" action="{{ route('admin.products') }}" method="get">
                    <input class="form-control border-0" name="keyword" type="search" placeholder="Tìm kiếm">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item">
                        <span class="nav-link">
                            <img class="rounded-circle me-lg-2" src="{{ asset('admin/img/user-default.png') }}" alt="Admin" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">ADMIN</span>
                        </span>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>

        <a href="#" class="btn btn-lg btn-danger btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <script>
        ['#categories-list', '#orders-list', '#comments-list', '#post-list', '#users-list', '#khohang-list'].forEach(function(selector) {
            if (document.querySelector(selector) && $.fn.DataTable) {
                $(selector).DataTable({
                    responsive: true,
                    searchable: true,
                    fixedHeight: false,
                    lengthMenu: [5, 10, 15, 20, 25],
                    pageLength: 5
                });
            }
        });

        ['#short_description', '#product_details'].forEach(function(selector) {
            var element = document.querySelector(selector);
            if (element && window.ClassicEditor) {
                ClassicEditor.create(element).catch(function(error) {
                    console.error(error);
                });
            }
        });

        function confirmDeletion() {
            return confirm('Bạn có chắc muốn xóa? Sau khi xóa sẽ không thể khôi phục!');
        }

        function confirmDeletionTemp() {
            return confirm('Bạn có chắc muốn đưa sản phẩm vào thùng rác?');
        }
    </script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
