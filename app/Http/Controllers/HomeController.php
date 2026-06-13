<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredNews = News::published()
            ->featured()
            ->with(['category', 'author'])
            ->recent()
            ->limit(5)
            ->get();

        $latestNews = News::published()
            ->with(['category', 'author'])
            ->recent()
            ->limit(9)
            ->get();

        $breakingNews = News::published()
            ->recent()
            ->limit(5)
            ->get();

        $popularNews = News::published()
            ->with(['category', 'author'])
            ->popular()
            ->limit(5)
            ->get();

        $categories = Category::active()
            ->ordered()
            ->withCount(['publishedNews'])
            ->get();

        $categoryNews = [];
        foreach ($categories as $category) {
            $categoryNews[$category->slug] = News::published()
                ->where('category_id', $category->id)
                ->with(['category', 'author'])
                ->recent()
                ->limit(4)
                ->get();
        }

        return view('home', compact(
            'featuredNews',
            'latestNews',
            'popularNews',
            'categories',
            'categoryNews',
            'breakingNews'
        ));
    }
}
