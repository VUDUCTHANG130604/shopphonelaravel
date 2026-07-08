<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->where('status', 1)->orderByDesc('post_id')->paginate(9);
        $categories = PostCategory::withCount('posts')->orderBy('name')->get();
        $recentPosts = Post::where('status', 1)->orderByDesc('post_id')->take(5)->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts'));
    }

    public function category(PostCategory $category)
    {
        $posts = Post::with('category')
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->orderByDesc('post_id')
            ->paginate(9);
        $categories = PostCategory::withCount('posts')->orderBy('name')->get();
        $recentPosts = Post::where('status', 1)->orderByDesc('post_id')->take(5)->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts', 'category'));
    }

    public function show(Post $post)
    {
        abort_unless((bool) $post->status, 404);

        $post->load('category');
        $post->increment('views');
        $categories = PostCategory::withCount('posts')->orderBy('name')->get();
        $recentPosts = Post::where('status', 1)
            ->where('post_id', '!=', $post->post_id)
            ->orderByDesc('post_id')
            ->take(5)
            ->get();

        return view('blog.show', compact('post', 'categories', 'recentPosts'));
    }
}
