<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = News::published()->with(['category', 'author']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        $news = $query->recent()->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('news.index', compact('news', 'categories'));
    }

    public function show(string $slug): View
    {
        $news = News::where('slug', $slug)
            ->published()
            ->with(['category', 'author', 'approvedComments.user', 'approvedComments.replies.user'])
            ->firstOrFail();

        $news->incrementViews();

        $relatedNews = News::published()
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->with(['category', 'author'])
            ->recent()
            ->limit(4)
            ->get();

        $isLiked = $news->isLikedBy(auth()->user());
        $isBookmarked = $news->isBookmarkedBy(auth()->user());

        return view('news.show', compact('news', 'relatedNews', 'isLiked', 'isBookmarked'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        $news = News::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->recent()
            ->paginate(12);

        return view('news.category', compact('category', 'news'));
    }
}
