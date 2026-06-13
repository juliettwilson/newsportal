<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
            'total_users' => User::count(),
            'total_comments' => Comment::count(),
            'total_views' => News::sum('views'),
            'total_likes' => News::sum('likes'),
        ];

        $recentNews = News::with(['category', 'author'])
            ->latest()
            ->limit(5)
            ->get();

        $recentUsers = User::latest()
            ->limit(5)
            ->get();

        $popularNews = News::published()
            ->with(['category'])
            ->popular()
            ->limit(5)
            ->get();

        $categories = Category::withCount('news')->get();

        return view('admin.dashboard', compact('stats', 'recentNews', 'recentUsers', 'popularNews', 'categories'));
    }
}
