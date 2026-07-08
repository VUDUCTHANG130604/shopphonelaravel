<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: "Heebo", sans-serif;
        }

        .btn-primary {
            background-color: black !important;
            border-color: black !important;
        }

        .spinner-border.text-primary {
            color: black !important;
        }

        .form-control:focus {
            border-color: black !important;
            box-shadow: 0 0 0 0.25rem rgba(45, 95, 63, 0.25) !important;
        }

        h3 {
            color: black !important;
        }

        .admin-login-alert {
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 16px;
            padding: 10px 12px;
        }
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <form action="{{ route('admin.login.store') }}" method="post" autocomplete="off">
                            @csrf
                            <input type="hidden" name="redirect" value="{{ $redirect ?? url('/admin') }}">

                            <h3 class="text-center mb-4">Đăng nhập Admin</h3>

                            @if(session('success'))
                                <div class="alert alert-success admin-login-alert">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger admin-login-alert">{{ session('error') }}</div>
                            @endif

                            @error('login')
                                <div class="alert alert-danger admin-login-alert">{{ $message }}</div>
                            @enderror

                            <div class="form-floating mb-3">
                                <input name="login" type="text" class="form-control" id="floatingInput"
                                    placeholder="Tên đăng nhập" value="{{ old('login') }}" required autofocus>
                                <label for="floatingInput">Tên đăng nhập</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input name="password" type="password" class="form-control" id="floatingPassword"
                                    placeholder="Mật khẩu" required>
                                <label for="floatingPassword">Mật khẩu</label>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{ asset('admin/js/main.js') }}"></script>
</body>

</html>
