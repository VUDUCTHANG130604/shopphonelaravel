<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('home.legacy');
Route::post('/index.php', [CartController::class, 'legacyIndexPost'])->name('legacy.index.post');
Route::get('/index.php', function () {
    $url = request('url', 'trang-chu');
    $id = request('id') ?? request('id_sp') ?? request('post_id');
    $categoryId = request('id') ?? request('id_dm');

    if ($url === 'gio-hang' && request('xoa') && Auth::check()) {
        \App\Models\Cart::where('user_id', Auth::user()->user_id)
            ->where('cart_id', request('xoa'))
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa 1 sản phẩm.');
    }

    return match ($url) {
        'trang-chu' => redirect()->route('home'),
        'cua-hang' => redirect()->route('shop.legacy'),
        'chitietsanpham' => $id ? redirect()->route('product.detail', $id) : redirect()->route('product.legacy'),
        'danh-muc-san-pham' => $categoryId ? redirect()->route('shop.category', $categoryId) : redirect()->route('shop.legacy'),
        'lien-he' => redirect()->route('contact'),
        'gio-hang' => redirect()->route('cart.index'),
        'thanh-toan' => redirect()->route('checkout'),
        'thanh-toan-2' => redirect()->route('checkout.address'),
        'thanh-toan-momo' => redirect()->route('checkout.momo'),
        'thanh-toan-momo-address' => redirect()->route('checkout.momo.address'),
        'thanh-toan-momo-address-2' => redirect()->route('checkout.momo.address2'),
        'thanh-toan-dia-chi2' => redirect()->route('checkout.address2'),
        'remove-address' => redirect()->route('account.address.remove'),
        'cam-on' => redirect()->route('thanks'),
        'don-hang' => redirect()->route('orders.index'),
        'chi-tiet-don-hang' => $id ? redirect()->route('orders.show', $id) : redirect()->route('orders.index'),
        'dang-nhap' => redirect()->route('login'),
        'dang-ky' => redirect()->route('register'),
        'thong-tin-tai-khoan' => redirect()->route('account.show'),
        'ho-so' => redirect()->route('account.edit'),
        'them-dia-chi' => redirect()->route('account.address'),
        'doi-mat-khau' => redirect()->route('account.password'),
        'quen-mat-khau' => redirect()->route('password.request'),
        'khoi-phuc-mat-khau' => redirect()->route('password.recovery'),
        'bai-viet' => redirect()->route('blog.index'),
        'chi-tiet-bai-viet' => $id ? redirect()->route('blog.show', $id) : redirect()->route('blog.index'),
        'danh-muc-bai-viet' => $id ? redirect()->route('blog.category', $id) : redirect()->route('blog.index'),
        'tim-kiem' => redirect()->route('shop.search', request()->query()),
        default => redirect()->route('home'),
    };
})->name('legacy.index');

Route::get('/shop', [ProductController::class, 'index'])
    ->name('shop.index');
Route::get('/cua-hang', [ProductController::class, 'index'])
    ->name('shop.legacy');
Route::get('/danh-muc-san-pham/{category}', [ProductController::class, 'category'])
    ->name('shop.category');
Route::get('/tim-kiem', [ProductController::class, 'search'])
    ->name('shop.search');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');
Route::get('/san-pham/{product}', [ProductController::class, 'show'])
    ->name('product.detail');
Route::post('/san-pham/{product}/binh-luan', [ProductController::class, 'comment'])
    ->name('product.comment');
Route::get('/chitietsanpham', [ProductController::class, 'legacyShow'])
    ->name('product.legacy');

Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang', [CartController::class, 'store'])->name('cart.store');
Route::put('/gio-hang', [CartController::class, 'updateMany'])->name('cart.update-many');
Route::patch('/gio-hang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/gio-hang/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('checkout');
Route::post('/thanh-toan', [CartController::class, 'placeOrder'])->name('checkout.place');
Route::get('/thanh-toan-2', [CartController::class, 'checkout'])->name('checkout.address');
Route::get('/thanh-toan-dia-chi2', [CartController::class, 'checkout'])->name('checkout.address2');
Route::get('/thanh-toan-momo', [CartController::class, 'momo'])->name('checkout.momo');
Route::post('/thanh-toan-momo', [CartController::class, 'placeMomoOrder'])->name('checkout.momo.place');
Route::get('/thanh-toan-momo-address', [CartController::class, 'momo'])->name('checkout.momo.address');
Route::post('/thanh-toan-momo-address', [CartController::class, 'placeMomoOrder'])->name('checkout.momo.address.place');
Route::get('/thanh-toan-momo-address-2', [CartController::class, 'momo'])->name('checkout.momo.address2');
Route::post('/thanh-toan-momo-address-2', [CartController::class, 'placeMomoOrder'])->name('checkout.momo.address2.place');

Route::get('/bai-viet', [BlogController::class, 'index'])->name('blog.index');
Route::get('/chi-tiet-bai-viet/{post}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/danh-muc-bai-viet/{category}', [BlogController::class, 'category'])->name('blog.category');

Route::view('/lien-he', 'pages.contact')->name('contact');
Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.store');
Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.store');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
Route::view('/cam-on', 'pages.thanks')->name('thanks');
Route::get('/don-hang', [PageController::class, 'orders'])->name('orders.index');
Route::get('/chi-tiet-don-hang/{order}', [PageController::class, 'orderDetail'])
    ->missing(fn () => redirect()->route('orders.index'))
    ->name('orders.show');
Route::post('/don-hang/{order}/huy', [PageController::class, 'cancelOrder'])
    ->missing(fn () => redirect()->route('orders.index'))
    ->name('orders.cancel');
Route::get('/thong-tin-tai-khoan', [PageController::class, 'account'])->name('account.show');
Route::get('/ho-so', [PageController::class, 'editProfile'])->name('account.edit');
Route::post('/ho-so', [PageController::class, 'updateProfile'])->name('account.update');
Route::get('/them-dia-chi', [PageController::class, 'address'])->name('account.address');
Route::post('/them-dia-chi', [PageController::class, 'storeAddress'])->name('account.address.store');
Route::get('/remove-address', [PageController::class, 'removeAddress'])->name('account.address.remove');
Route::get('/doi-mat-khau', [PageController::class, 'changePassword'])->name('account.password');
Route::post('/doi-mat-khau', [PageController::class, 'updatePassword'])->name('account.password.update');
Route::get('/quen-mat-khau', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/quen-mat-khau', [AuthController::class, 'resetPassword'])->name('password.reset.simple');
Route::get('/khoi-phuc-mat-khau', [AuthController::class, 'forgotPassword'])->name('password.recovery');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login.php', fn () => Auth::guard('admin')->check()
        ? redirect()->route('admin.dashboard')
        : view('auth.admin-login', ['redirect' => request('redirect', url('/admin'))]))->name('legacy.login');
    Route::get('/login', fn () => Auth::guard('admin')->check()
        ? redirect()->route('admin.dashboard')
        : view('auth.admin-login', ['redirect' => request('redirect', url('/admin'))]))->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.store');

    Route::middleware('admin.only')->group(function () {
    Route::post('/logout', function () {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    })->name('logout');

    Route::get('/index.php', function () {
        $id = request('id');

        if (request('quanli') === 'cap-nhat-san-pham' && $id) {
            return redirect()->route('admin.products.edit', $id);
        }

        if (request('quanli') === 'cap-nhat-danh-muc' && $id) {
            return redirect()->route('admin.categories.edit', $id);
        }

        if (request('quanli') === 'cap-nhat-don-hang' && $id) {
            return redirect()->route('admin.orders.show', $id);
        }

        if (request('quanli') === 'cap-nhat-bai-viet' && $id) {
            return redirect()->route('admin.posts.edit', $id);
        }

        if (request('quanli') === 'cap-nhat-danh-muc-bai-viet' && $id) {
            return redirect()->route('admin.post-categories', ['edit' => $id]);
        }

        if (request('quanli') === 'thung-rac-san-pham' && request('xoatam')) {
            \App\Models\Product::where('product_id', request('xoatam'))->update(['status' => 0]);
            return redirect()->route('admin.products.recycle')->with('success', 'Đã đưa sản phẩm vào thùng rác.');
        }

        if (request('quanli') === 'thung-rac-san-pham' && request('xoa')) {
            \App\Models\Product::where('product_id', request('xoa'))->delete();
            return redirect()->route('admin.products.recycle')->with('success', 'Đã xóa vĩnh viễn sản phẩm.');
        }
        if (request('quanli') === 'chi-tiet-binh-luan' && request('id')) {
            return redirect()->route('admin.comments.show', request('id'));
        }

        if (request('quanli') === 'thung-rac-san-pham' && request('khoiphuc')) {
            \App\Models\Product::where('product_id', request('khoiphuc'))->update(['status' => 1]);
            return redirect()->route('admin.products.recycle')->with('success', 'Đã khôi phục sản phẩm.');
        }

        if (request('quanli') === 'danh-sach-don-cho') {
            return redirect('/admin/don-hang?status=1');
        }

        if (request('quanli') === 'dang-xuat') {
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login');
        }

        $route = match (request('quanli')) {
            'danh-sach-san-pham' => 'admin.products',
            'them-san-pham' => 'admin.products.create',
            'thung-rac-san-pham' => 'admin.products.recycle',
            'danh-sach-danh-muc' => 'admin.categories',
            'them-danh-muc' => 'admin.categories.create',
            'danh-sach-don-hang', 'cap-nhat-don-hang' => 'admin.orders',
            'danh-sach-bai-viet' => 'admin.posts',
            'them-bai-viet' => 'admin.posts.create',
            'danh-muc-bai-viet', 'cap-nhat-danh-muc-bai-viet' => 'admin.post-categories',
            'danh-sach-khach-hang' => 'admin.users',
            'them-tai-khoan' => 'admin.users.create',
            'binh-luan', 'chi-tiet-binh-luan' => 'admin.comments',
            'thong-ke-san-pham' => 'admin.stats.products',
            'thong-ke-don-hang' => 'admin.stats.orders',
            'bieu-do-luot-ban' => 'admin.stats.chart',
            'top-luot-ban' => 'admin.stats.top',
            'luot-ban-theo-ngay' => 'admin.stats.days',
            'xuat-exel' => 'admin.export.orders',
            'kho-hang' => 'admin.warehouse',
            'kho-hang2' => 'admin.warehouse.products',
            'nhap-hang', 'them-hoa-don' => 'admin.warehouse.import',
            default => 'admin.dashboard',
        };

        return redirect()->route($route);
    })->name('legacy.index');
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/san-pham', [AdminController::class, 'products'])->name('products');
    Route::get('/thung-rac-san-pham', [AdminController::class, 'recycleProducts'])->name('products.recycle');
    Route::get('/san-pham/them', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/san-pham', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/san-pham/{product}/sua', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/san-pham/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::patch('/san-pham/{product}/trang-thai', [AdminController::class, 'toggleProduct'])->name('products.toggle');
    Route::delete('/san-pham/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
    Route::patch('/san-pham/{product}/khoi-phuc', [AdminController::class, 'restoreProduct'])->name('products.restore');
    Route::delete('/san-pham/{product}/xoa-vinh-vien', [AdminController::class, 'forceDestroyProduct'])->name('products.force-destroy');
    Route::get('/danh-muc', [AdminController::class, 'categories'])->name('categories');
    Route::get('/danh-muc/them', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/danh-muc', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/danh-muc/{category}/sua', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/danh-muc/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/danh-muc/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    Route::get('/don-hang', [AdminController::class, 'orders'])->name('orders');
    Route::get('/don-hang-cho', fn () => redirect()->route('admin.orders', ['status' => 1]))->name('orders.pending');
    Route::get('/don-hang/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::patch('/don-hang/{order}/trang-thai', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
    Route::get('/bai-viet', [AdminController::class, 'posts'])->name('posts');
    Route::get('/bai-viet/them', [AdminController::class, 'createPost'])->name('posts.create');
    Route::post('/bai-viet', [AdminController::class, 'storePost'])->name('posts.store');
    Route::get('/bai-viet/{post}/sua', [AdminController::class, 'editPost'])->name('posts.edit');
    Route::put('/bai-viet/{post}', [AdminController::class, 'updatePost'])->name('posts.update');
    Route::delete('/bai-viet/{post}', [AdminController::class, 'destroyPost'])->name('posts.destroy');
    Route::get('/danh-muc-bai-viet', [AdminController::class, 'postCategories'])->name('post-categories');
    Route::post('/danh-muc-bai-viet', [AdminController::class, 'storePostCategory'])->name('post-categories.store');
    Route::put('/danh-muc-bai-viet/{category}', [AdminController::class, 'updatePostCategory'])->name('post-categories.update');
    Route::delete('/danh-muc-bai-viet/{category}', [AdminController::class, 'destroyPostCategory'])->name('post-categories.destroy');
    Route::get('/thanh-vien', [AdminController::class, 'users'])->name('users');
    Route::get('/thanh-vien/them', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/thanh-vien', [AdminController::class, 'storeUser'])->name('users.store');
    Route::patch('/thanh-vien/{user}/trang-thai', [AdminController::class, 'toggleUser'])->name('users.toggle');
    Route::delete('/thanh-vien/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/binh-luan', [AdminController::class, 'comments'])->name('comments');
    Route::get('/binh-luan/{comment}', [AdminController::class, 'showComment'])->name('comments.show');
    Route::patch('/binh-luan/{comment}/trang-thai', [AdminController::class, 'toggleComment'])->name('comments.toggle');
    Route::delete('/binh-luan/{comment}', [AdminController::class, 'destroyComment'])->name('comments.destroy');
    Route::get('/thong-ke-san-pham', [AdminController::class, 'productStats'])->name('stats.products');
    Route::get('/thong-ke-don-hang', [AdminController::class, 'orderStats'])->name('stats.orders');
    Route::get('/bieu-do-luot-ban', [AdminController::class, 'topOrders'])->name('stats.chart');
    Route::get('/top-luot-ban', [AdminController::class, 'topOrders'])->name('stats.top');
    Route::get('/luot-ban-theo-ngay', [AdminController::class, 'salesByDay'])->name('stats.days');
    Route::get('/xuat-exel', [AdminController::class, 'exportOrders'])->name('export.orders');
    Route::get('/kho-hang', [AdminController::class, 'warehouseProducts'])->name('warehouse');
    Route::get('/kho-hang2', [AdminController::class, 'warehouseProducts'])->name('warehouse.products');
    Route::post('/kho-hang2/dieu-chinh', [AdminController::class, 'adjustWarehouseStock'])->name('warehouse.adjust');
    Route::get('/nhap-hang', [AdminController::class, 'importStock'])->name('warehouse.import');
    Route::post('/nhap-hang', [AdminController::class, 'storeWarehouse'])->name('warehouse.store');
    Route::get('/them-hoa-don', [AdminController::class, 'importStock'])->name('warehouse.invoice');
    Route::get('/{legacy}', function (string $legacy) {
        [$page, $queryString] = array_pad(explode('&', $legacy, 2), 2, '');
        parse_str($queryString, $params);
        $id = $params['id'] ?? null;

        if ($page === 'cap-nhat-san-pham' && $id) {
            return redirect()->route('admin.products.edit', $id);
        }

        if ($page === 'cap-nhat-danh-muc' && $id) {
            return redirect()->route('admin.categories.edit', $id);
        }

        if ($page === 'cap-nhat-don-hang' && $id) {
            return redirect()->route('admin.orders.show', $id);
        }

        if ($page === 'cap-nhat-bai-viet' && $id) {
            return redirect()->route('admin.posts.edit', $id);
        }

        if ($page === 'cap-nhat-danh-muc-bai-viet' && $id) {
            return redirect()->route('admin.post-categories', ['edit' => $id]);
        }

        if ($page === 'chi-tiet-binh-luan' && $id) {
            return redirect()->route('admin.comments.show', $id);
        }

        if ($page === 'danh-sach-bai-viet' && isset($params['xoa'])) {
            \App\Models\Post::where('post_id', $params['xoa'])->delete();
            return redirect()->route('admin.posts')->with('success', 'Đã xóa bài viết.');
        }

        if ($page === 'danh-muc-bai-viet' && isset($params['xoa'])) {
            $category = \App\Models\PostCategory::find($params['xoa']);
            if ($category && !$category->posts()->exists()) {
                $category->delete();
                return redirect()->route('admin.post-categories')->with('success', 'Đã xóa chuyên mục bài viết.');
            }

            return redirect()->route('admin.post-categories')->withErrors(['name' => 'Không được xóa chuyên mục chứa bài viết.']);
        }

        return redirect()->route('admin.dashboard');
    })->where('legacy', '.*')->name('legacy.short');
    });
});
