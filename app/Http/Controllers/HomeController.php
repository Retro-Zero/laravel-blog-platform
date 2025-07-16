<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'total_posts' => Post::where('status', 'published')->count(),
            'total_users' => User::count(),
            'total_comments' => Comment::count(),
        ];

        $featuredPosts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('latestPosts', 'stats', 'featuredPosts'));
    }
} 