<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        [$categories, $minMaxPrice] = $this->shopFilters();
        $products = Product::with('category')
            ->where('status', 1)
            ->orderByDesc('product_id')
            ->paginate(9)
            ->withQueryString();

        return view('shop.index', compact('products', 'categories', 'minMaxPrice'));
    }

    public function category(Category $category)
    {
        [$categories, $minMaxPrice] = $this->shopFilters();
        $products = Product::with('category')
            ->where('status', 1)
            ->where('category_id', $category->category_id)
            ->orderByDesc('product_id')
            ->paginate(9);

        return view('shop.index', compact('products', 'categories', 'category', 'minMaxPrice'));
    }

    public function search(Request $request)
    {
        $query = trim((string) $request->query('query', ''));
        $fromPrice = $request->query('from_price');
        $toPrice = $request->query('to_price');

        [$categories, $minMaxPrice] = $this->shopFilters();
        $products = Product::with('category')
            ->where('status', 1)
            ->when($query !== '', fn ($builder) => $builder->where('name', 'like', "%{$query}%"))
            ->when($fromPrice !== null && $toPrice !== null && $fromPrice !== '' && $toPrice !== '', fn ($builder) => $builder->whereBetween('sale_price', [(int) $fromPrice, (int) $toPrice]))
            ->orderByDesc('product_id')
            ->paginate(9)
            ->withQueryString();

        return view('shop.index', compact('products', 'categories', 'query', 'minMaxPrice'));
    }

    public function legacyShow(Request $request)
    {
        $productId = $request->query('id_sp') ?: $request->query('id');

        abort_unless($productId, 404);

        return $this->show($productId);
    }

    public function show($id)
    {
        $product = Product::with([
            'category',
            'comments' => fn ($query) => $query->where('status', 1)->with('user')->orderByDesc('comment_id'),
        ])
            ->where('status', 1)
            ->where('product_id', $id)
            ->firstOrFail();

        $product->increment('views');

        $similarProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'similarProducts'));
    }

    public function comment(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để bình luận.');
        }

        $data = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ], [
            'content.required' => 'Nội dung bình luận không được để trống.',
            'content.max' => 'Nội dung bình luận tối đa 1000 ký tự.',
        ]);

        Comment::create([
            'user_id' => Auth::user()->user_id,
            'product_id' => $product->product_id,
            'content' => $data['content'],
            'date' => now(),
            'status' => 1,
        ]);

        return back()->with('success', 'Đã gửi bình luận.');
    }
    private function shopFilters(): array
    {
        return Cache::remember('shop.filters', 60, function () {
            return [
                Category::where('status', 1)->orderBy('name')->get(),
                Product::where('status', 1)
                    ->selectRaw('MIN(sale_price) as min_price, MAX(sale_price) as max_price')
                    ->first(),
            ];
        });
    }
}
