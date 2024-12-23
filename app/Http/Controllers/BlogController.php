<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy bài viết nổi bật mới nhất
        $featuredPost = Post::with(['user' => function($query) {
            $query->select('user_id', 'full_name', 'email');
        }])
        ->select('id', 'title', 'excerpt', 'featured_image', 'user_id', 'created_at')
        ->latest()
        ->first();

        // Lấy 3 bài viết mới nhất
        $latestPosts = Post::with(['user' => function($query) {
            $query->select('user_id', 'full_name', 'email');
        }])
        ->select('id', 'title', 'excerpt', 'featured_image', 'user_id', 'created_at')
        ->latest()
        ->take(3)
        ->get();

        // Dữ liệu mẫu cho categories
        $categories = [
            ['name' => 'Du lịch Việt Nam'],
            ['name' => 'Ẩm thực'],
            ['name' => 'Du lịch bụi'],
            ['name' => 'Du lịch biển'],     
            ['name' => 'Văn hóa'],
            ['name' => 'Mẹo du lịch']
        ];

        return view('blog', compact('featuredPost', 'latestPosts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::with([
            'comments' => function($query) {
                $query->whereNull('parent_id')
                      ->with(['user', 'replies.user'])
                      ->latest();
            },
            'user'
        ])->findOrFail($id);
    
        return view('blog.show', compact('post'));
    }
    
}
