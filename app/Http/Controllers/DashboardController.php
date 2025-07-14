<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get chart data
        $chartData = $this->getChartData($user);
        
        return view('dashboard', compact('chartData'));
    }
    
    private function getChartData($user)
    {
        // Post Views Chart (last 7 days)
        $postViewsData = $this->getPostViewsData($user);
        
        // Post Categories Chart
        $postCategoriesData = $this->getPostCategoriesData($user);
        
        // Monthly Posts Chart (last 6 months)
        $monthlyPostsData = $this->getMonthlyPostsData($user);
        
        // Comments Activity Chart (last 7 days)
        $commentsActivityData = $this->getCommentsActivityData($user);
        
        return [
            'postViews' => $postViewsData,
            'postCategories' => $postCategoriesData,
            'monthlyPosts' => $monthlyPostsData,
            'commentsActivity' => $commentsActivityData,
        ];
    }
    
    private function getPostViewsData($user)
    {
        $labels = [];
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');
            
            // Get total views for user's posts on this date
            $views = $user->posts()
                ->join('post_views', 'posts.id', '=', 'post_views.post_id')
                ->whereDate('post_views.created_at', $date->format('Y-m-d'))
                ->count();
            
            $data[] = $views;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getPostCategoriesData($user)
    {
        $categories = $user->posts()
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(*) as count')
            ->groupBy('categories.id', 'categories.name')
            ->get();
        
        $labels = $categories->pluck('name')->toArray();
        $data = $categories->pluck('count')->toArray();
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getMonthlyPostsData($user)
    {
        $labels = [];
        $data = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');
            
            $posts = $user->posts()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $data[] = $posts;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getCommentsActivityData($user)
    {
        $labels = [];
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('M d');
            
            // Get comments received on user's posts on this date
            $comments = Comment::whereIn('post_id', $user->posts()->pluck('id'))
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->count();
            
            $data[] = $comments;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
} 