<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $chartType = in_array($request->query('type_chart'), ['bar', 'line', 'doughnut'], true)
            ? $request->query('type_chart')
            : 'bar';
        $limitDay = (int) $request->query('limit_day', 10);
        $limitDay = in_array($limitDay, [7, 10, 14, 21, 30, 100], true) ? $limitDay : 10;

        $stats = [
            'revenue' => (int) DB::table('orders')->where('status', 4)->sum('total'),
            'products' => Product::where('status', 1)->count(),
            'pendingOrders' => DB::table('orders')->where('status', 1)->count(),
            'users' => User::count(),
            'categories' => Category::count(),
            'posts' => Post::count(),
            'comments' => Comment::count(),
        ];

        $latestOrders = DB::table('orders')
            ->leftJoin('users', 'users.user_id', '=', 'orders.user_id')
            ->select('orders.*', 'users.full_name', 'users.name')
            ->orderByDesc('orders.order_id')
            ->take(6)
            ->get();

        $topProducts = Product::orderByDesc('sell_quantity')->take(6)->get();
        $chartRows = DB::table('orderdetails')
            ->leftJoin('orders', 'orders.order_id', '=', 'orderdetails.order_id')
            ->select(DB::raw('DATE(orders.date) as day'), DB::raw('SUM(orderdetails.quantity) as sold_quantity'))
            ->whereNotNull('orders.date')
            ->groupBy(DB::raw('DATE(orders.date)'))
            ->orderByDesc('day')
            ->take($limitDay)
            ->get();

        $chartRows = $chartRows->reverse()->values();
        $soldQuantities = $chartRows->pluck('sold_quantity')->map(fn ($value) => (int) $value);
        $chartSummary = [
            'total_sold' => $soldQuantities->sum(),
            'avg_sold' => $soldQuantities->count() ? round($soldQuantities->avg(), 1) : 0,
            'max_sold' => $soldQuantities->max() ?? 0,
            'min_sold' => $soldQuantities->min() ?? 0,
        ];

        return view('admin.dashboard', compact('stats', 'latestOrders', 'topProducts', 'chartRows', 'chartType', 'limitDay', 'chartSummary'));
    }

    public function products(Request $request)
    {
        $keyword = trim((string) $request->query('keyword', ''));
        $categoryId = (int) $request->query('category_id', 0);

        $rows = Product::with('category')
            ->when($keyword !== '', fn ($query) => $query->where('name', 'like', "%{$keyword}%"))
            ->when($categoryId > 0, fn ($query) => $query->where('category_id', $categoryId))
            ->where('status', 1)
            ->orderByDesc('product_id')
            ->paginate(5)
            ->withQueryString();
        $categories = Category::orderBy('name')->get();
        $totalProducts = Product::where('status', 1)->count();
        $recycleCount = Product::where('status', 0)->count();
        $isRecycle = false;

        return view('admin.tables.products', compact('rows', 'categories', 'totalProducts', 'recycleCount', 'keyword', 'categoryId', 'isRecycle'));
    }

    public function createProduct()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.forms.product', ['product' => new Product(), 'categories' => $categories]);
    }

    public function storeProduct(Request $request)
    {
        Product::create($this->productData($request));
        return redirect()->route('admin.products')->with('success', 'Đã thêm sản phẩm.');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.forms.product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $product->update($this->productData($request, $product));
        return redirect()->route('admin.products')->with('success', 'Đã cập nhật sản phẩm.');
    }

    public function toggleProduct(Product $product)
    {
        $product->update(['status' => $product->status ? 0 : 1]);
        return back();
    }

    public function destroyProduct(Product $product)
    {
        $product->update(['status' => 0]);
        return back()->with('success', 'Đã ẩn sản phẩm.');
    }

    public function restoreProduct(Product $product)
    {
        $product->update(['status' => 1]);
        return back()->with('success', 'Đã khôi phục sản phẩm.');
    }

    public function forceDestroyProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.recycle')->with('success', 'Đã xóa vĩnh viễn sản phẩm.');
    }

    public function categories()
    {
        $rows = Category::withCount('products')->orderBy('category_id')->paginate(12);

        return view('admin.tables.categories', compact('rows'));
    }

    public function createCategory()
    {
        return view('admin.forms.category', ['category' => new Category()]);
    }

    public function storeCategory(Request $request)
    {
        Category::create($this->categoryData($request));
        return redirect()->route('admin.categories')->with('success', 'Đã thêm danh mục.');
    }

    public function editCategory(Category $category)
    {
        return view('admin.forms.category', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $category->update($this->categoryData($request, $category));
        return redirect()->route('admin.categories')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroyCategory(Category $category)
    {
        $category->update(['status' => 0]);
        return back()->with('success', 'Đã ẩn danh mục.');
    }

    public function orders(Request $request)
    {
        $rows = DB::table('orders')
            ->leftJoin('users', 'users.user_id', '=', 'orders.user_id')
            ->select('orders.*', 'users.full_name', 'users.name', 'users.email')
            ->when($request->filled('status'), fn ($query) => $query->where('orders.status', (int) $request->query('status')))
            ->orderByDesc('orders.order_id')
            ->get();

        return view('admin.tables.orders', compact('rows'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['details.product', 'user']);
        return view('admin.tables.order-show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $data = $request->validate(['status' => ['required', 'integer', 'min:0', 'max:4']]);
        $order->update($data);
        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng.');
    }

    public function posts()
    {
        $rows = Post::with('category')->orderByDesc('post_id')->paginate(12);

        return view('admin.tables.posts', compact('rows'));
    }

    public function createPost()
    {
        $categories = PostCategory::orderBy('name')->get();
        return view('admin.forms.post', ['post' => new Post(), 'categories' => $categories]);
    }

    public function storePost(Request $request)
    {
        Post::create($this->postData($request));
        return redirect()->route('admin.posts')->with('success', 'Đã thêm bài viết.');
    }

    public function editPost(Post $post)
    {
        $categories = PostCategory::orderBy('name')->get();
        return view('admin.forms.post', compact('post', 'categories'));
    }

    public function updatePost(Request $request, Post $post)
    {
        $post->update($this->postData($request, $post));
        return redirect()->route('admin.posts')->with('success', 'Đã cập nhật bài viết.');
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Đã xóa bài viết.');
    }

    public function postCategories()
    {
        $rows = PostCategory::withCount('posts')->orderBy('id')->paginate(12);
        $editCategory = request('edit') ? PostCategory::find(request('edit')) : null;

        return view('admin.tables.post-categories', compact('rows', 'editCategory'));
    }

    public function storePostCategory(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255', 'unique:post_categories,name']]);
        PostCategory::create($data);

        return back()->with('success', 'Đã thêm danh mục bài viết.');
    }

    public function updatePostCategory(Request $request, PostCategory $category)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255', 'unique:post_categories,name,'.$category->id]]);
        $category->update($data);

        return back()->with('success', 'Đã cập nhật danh mục bài viết.');
    }

    public function destroyPostCategory(PostCategory $category)
    {
        if ($category->posts()->exists()) {
            return back()->withErrors(['name' => 'Khong duoc xoa chuyen muc chua bai viet.']);
        }

        $category->delete();

        return back()->with('success', 'Đã xóa danh mục bài viết.');
    }

    public function users()
    {
        $rows = User::orderByDesc('user_id')->get();

        return view('admin.tables.users', compact('rows'));
    }

    public function createUser()
    {
        return view('admin.forms.user', ['user' => new User()]);
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^(03|05|07|08|09)[0-9]{8}$/', 'unique:users,phone'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirm' => ['required', 'same:password'],
            'role' => ['nullable', 'integer', 'min:0', 'max:1'],
            'active' => ['nullable', 'boolean'],
        ]);

        $data['user_id'] = ((int) User::max('user_id')) + 1;
        $data['name'] = $data['full_name'];
        $data['image'] = 'user-default.png';
        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirm']);
        $data['role'] = (int) ($data['role'] ?? 0);
        $data['active'] = $request->boolean('active', true);

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'Đã thêm tài khoản.');
    }

    public function comments()
    {
        $rows = Comment::query()
            ->leftJoin('products', 'products.product_id', '=', 'comments.product_id')
            ->leftJoin('users', 'users.user_id', '=', 'comments.user_id')
            ->select('comments.*', 'products.name as product_name', 'users.full_name', 'users.name')
            ->orderByDesc('comment_id')
            ->paginate(12);

        return view('admin.tables.comments', compact('rows'));
    }

    public function showComment(Comment $comment)
    {
        $comment->load(['product', 'user']);

        return view('admin.tables.comment-show', compact('comment'));
    }

    public function toggleUser(User $user)
    {
        $user->update(['active' => $user->active ? 0 : 1]);
        return back();
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Đã xóa tài khoản.');
    }

    public function toggleComment(Comment $comment)
    {
        $comment->update(['status' => $comment->status ? 0 : 1]);
        return back();
    }

    public function destroyComment(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Đã xóa bình luận.');
    }

    public function recycleProducts()
    {
        $keyword = '';
        $categoryId = 0;
        $categories = Category::orderBy('name')->get();
        $totalProducts = Product::where('status', 1)->count();
        $recycleCount = Product::where('status', 0)->count();
        $isRecycle = true;
        $rows = Product::with('category')->where('status', 0)->orderByDesc('product_id')->paginate(12);

        return view('admin.tables.products', compact('rows', 'categories', 'totalProducts', 'recycleCount', 'keyword', 'categoryId', 'isRecycle'));
    }

    public function productStats()
    {
        $categoryStats = DB::table('categories')
            ->leftJoin('products', 'products.category_id', '=', 'categories.category_id')
            ->select(
                'categories.name as cate_name',
                DB::raw('COUNT(products.product_id) as count_products'),
                DB::raw('MIN(products.price) as min_price'),
                DB::raw('MAX(products.price) as max_price'),
                DB::raw('AVG(products.price) as avg_product')
            )
            ->groupBy('categories.category_id', 'categories.name')
            ->orderByDesc('count_products')
            ->get();

        return view('admin.stats.products', compact('categoryStats'));
    }

    public function orderStats()
    {
        $rows = DB::table('orderdetails')
            ->leftJoin('orders', 'orders.order_id', '=', 'orderdetails.order_id')
            ->leftJoin('products', 'products.product_id', '=', 'orderdetails.product_id')
            ->leftJoin('categories', 'categories.category_id', '=', 'products.category_id')
            ->select(
                'categories.name as cate_name',
                'products.name as product_name',
                DB::raw('COUNT(DISTINCT orders.order_id) as count_orders'),
                DB::raw('SUM(orderdetails.quantity) as total_sold_quantity')
            )
            ->groupBy('categories.name', 'products.name')
            ->orderByDesc('total_sold_quantity')
            ->get();

        return view('admin.stats.orders', compact('rows'));
    }

    public function topOrders(Request $request)
    {
        $top = (int) $request->query('top', 10);
        $top = in_array($top, [5, 10, 15, 30, 100], true) ? $top : 10;
        $rows = DB::table('orderdetails')
            ->leftJoin('products', 'products.product_id', '=', 'orderdetails.product_id')
            ->select('orderdetails.product_id', 'products.name', DB::raw('SUM(orderdetails.quantity) as sold'), DB::raw('SUM(orderdetails.quantity * orderdetails.price) as revenue'))
            ->groupBy('orderdetails.product_id', 'products.name')
            ->orderByDesc('sold')
            ->take($top)
            ->get();

        return view('admin.stats.top', compact('rows', 'top'));
    }

    public function salesByDay(Request $request)
    {
        $chartType = in_array($request->query('type_chart'), ['bar', 'line', 'doughnut'], true)
            ? $request->query('type_chart')
            : 'bar';
        $limitDay = (int) $request->query('limit_day', 10);
        $limitDay = in_array($limitDay, [7, 10, 14, 21, 30, 100], true) ? $limitDay : 10;

        $rows = DB::table('orderdetails')
            ->leftJoin('orders', 'orders.order_id', '=', 'orderdetails.order_id')
            ->select(DB::raw('DATE(orders.date) as day'), DB::raw('SUM(orderdetails.quantity) as sold_quantity'))
            ->whereNotNull('orders.date')
            ->groupBy(DB::raw('DATE(orders.date)'))
            ->orderByDesc('day')
            ->take($limitDay)
            ->get()
            ->reverse()
            ->values();

        $soldQuantities = $rows->pluck('sold_quantity')->map(fn ($value) => (int) $value);
        $summary = [
            'total_sold' => $soldQuantities->sum(),
            'avg_sold' => $soldQuantities->count() ? round($soldQuantities->avg(), 1) : 0,
            'max_sold' => $soldQuantities->max() ?? 0,
            'min_sold' => $soldQuantities->min() ?? 0,
        ];

        return view('admin.stats.days', compact('rows', 'chartType', 'limitDay', 'summary'));
    }

    public function exportOrders()
    {
        $orders = DB::table('orders')
            ->leftJoin('users', 'users.user_id', '=', 'orders.user_id')
            ->select('orders.order_id', 'orders.date', 'orders.total', 'orders.status', 'users.full_name', 'users.email', 'users.phone')
            ->orderByDesc('orders.order_id')
            ->get();

        $lines = ["ID,Ngay,TongTien,TrangThai,KhachHang,Email,DienThoai"];
        foreach ($orders as $order) {
            $lines[] = implode(',', array_map(fn ($value) => '"'.str_replace('"', '""', (string) $value).'"', [
                $order->order_id,
                $order->date,
                $order->total,
                $order->status,
                $order->full_name,
                $order->email,
                $order->phone,
            ]));
        }

        return response(implode("\n", $lines), 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=orders.csv',
        ]);
    }

    public function warehouse()
    {
        $rows = Warehouse::orderByDesc('id')->paginate(12);

        return view('admin.warehouse.index', compact('rows'));
    }

    public function warehouseProducts(Request $request)
    {
        $keyword = trim((string) $request->query('keyword', ''));
        $categoryId = (int) $request->query('category_id', 0);
        $categories = Category::orderBy('name')->get();
        $statistics = [
            'total_products' => Product::count(),
            'total_quantity' => (int) Product::sum('quantity'),
            'low_stock' => Product::where('quantity', '>', 0)->where('quantity', '<', 10)->count(),
            'out_of_stock' => Product::where('quantity', 0)->count(),
        ];
        $rows = Product::with('category')
            ->when($keyword !== '', fn ($query) => $query->where('name', 'like', "%{$keyword}%"))
            ->when($categoryId > 0, fn ($query) => $query->where('category_id', $categoryId))
            ->orderBy('quantity')
            ->paginate(10)
            ->withQueryString();

        return view('admin.warehouse.products', compact('rows', 'categories', 'statistics', 'keyword', 'categoryId'));
    }

    public function importStock()
    {
        $products = Product::orderBy('name')->get();

        return view('admin.warehouse.import', compact('products'));
    }

    public function adjustWarehouseStock(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,product_id'],
            'new_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Product::where('product_id', $data['product_id'])->update(['quantity' => $data['new_quantity']]);

        return back()->with('success', 'Da cap nhat so luong ton kho.');
    }

    public function storeWarehouse(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,product_id'],
            'import_price' => ['nullable', 'integer', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $price = (int) ($data['import_price'] ?? $product->price);

        Warehouse::create([
            'name' => $product->name,
            'price' => $price,
            'quantity' => $data['quantity'],
            'sell' => 0,
        ]);

        $product->increment('quantity', $data['quantity']);
        if (!empty($data['import_price'])) {
            $product->update(['price' => $price]);
        }

        return redirect()->route('admin.warehouse')->with('success', 'Đã nhập kho.');
    }

    private function productData(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:categories,category_id'],
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['required', 'numeric', 'min:0', 'lte:price'],
            'short_description' => ['nullable', 'string'],
            'details' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUpload($request->file('image'));
        } elseif ($product) {
            unset($data['image']);
        } else {
            $data['image'] = 'default-product.jpg';
        }

        $data['status'] = $request->boolean('status');
        return $data;
    }

    private function categoryData(Request $request, ?Category $category = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUpload($request->file('image'));
        } elseif ($category) {
            unset($data['image']);
        } else {
            $data['image'] = 'default-product.jpg';
        }

        $data['status'] = $request->boolean('status');
        return $data;
    }

    private function postData(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:post_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'author' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeUpload($request->file('image'));
        } elseif ($post) {
            unset($data['image']);
        } else {
            $data['image'] = 'default-product.jpg';
        }

        $data['author'] = $data['author'] ?: 'Admin';
        $data['status'] = $request->boolean('status');
        return $data;
    }

    private function storeUpload($file): string
    {
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('upload'), $filename);
        return $filename;
    }
}
