<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $homeData = Cache::remember('home.index.data', 60, function () {
            return [
                'listProducts' => Product::latest('product_id')->take(8)->get(),
                'list_posts' => Post::where('status', 1)->orderByDesc('post_id')->take(4)->get(),
                'listProductBanChay' => Product::orderByDesc('sell_quantity')->take(8)->get(),
                'listCategories' => Category::take(8)->get(),
                'product_limit_3' => Product::take(3)->get(),
                'product_order_by' => Product::orderBy('product_id')->take(3)->get(),
            ];
        });

        extract($homeData);

        return view('home', compact(
            'listProducts',
            'listProductBanChay',
            'listCategories',
            'product_limit_3',
            'product_order_by',
            'list_posts'
        ));
    }
}
