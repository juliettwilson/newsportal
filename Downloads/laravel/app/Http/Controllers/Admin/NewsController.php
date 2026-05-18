<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $query = News::with(['category', 'author']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $news = $query->latest()->paginate(15);
        $categories = Category::active()->ordered()->get();

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNews($request);
        
        $validated['slug'] = Str::slug($validated['title_en'] ?: $validated['title_kk']);
        $validated['author_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle video URL
        if ($request->filled('video_url')) {
            $validated['video_type'] = $this->detectVideoType($validated['video_url']);
        }

        if ($validated['is_published'] && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', __('admin.news_created'));
    }

    public function show(News $news): RedirectResponse
    {
        return redirect()->route('admin.news.edit', $news);
    }

    public function edit(News $news): View
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $this->validateNews($request, $news->id);

        // Update slug only if title changed
        if ($validated['title_en'] !== $news->title_en || $validated['title_kk'] !== $news->title_kk) {
            $validated['slug'] = Str::slug($validated['title_en'] ?: $validated['title_kk']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Handle video URL
        if ($request->filled('video_url')) {
            $validated['video_type'] = $this->detectVideoType($validated['video_url']);
        } else {
            $validated['video_url'] = null;
            $validated['video_type'] = null;
        }

        if ($validated['is_published'] && !$news->published_at && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', __('admin.news_updated'));
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', __('admin.news_deleted'));
    }

    public function togglePublish(News $news): RedirectResponse
    {
        $news->update([
            'is_published' => !$news->is_published,
            'published_at' => !$news->is_published ? now() : $news->published_at,
        ]);

        return back()->with('success', $news->is_published 
            ? __('admin.news_published') 
            : __('admin.news_unpublished'));
    }

    public function toggleFeatured(News $news): RedirectResponse
    {
        $news->update(['is_featured' => !$news->is_featured]);

        return back()->with('success', __('admin.news_updated'));
    }

    protected function validateNews(Request $request, ?int $newsId = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title_kk' => ['required', 'string', 'max:255'],
            'title_ru' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'excerpt_kk' => ['nullable', 'string', 'max:500'],
            'excerpt_ru' => ['nullable', 'string', 'max:500'],
            'excerpt_en' => ['nullable', 'string', 'max:500'],
            'content_kk' => ['required', 'string'],
            'content_ru' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'video_url' => ['nullable', 'url'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function detectVideoType(string $url): ?string
    {
        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            return 'youtube';
        }
        if (str_contains($url, 'vimeo.com')) {
            return 'vimeo';
        }
        return 'local';
    }
}
