<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('news')->ordered()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_kk' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'description_kk' => ['nullable', 'string', 'max:500'],
            'description_ru' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string', 'max:500'],
            'color' => ['required', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name_en']);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.category_created'));
    }

    public function show(Category $category): RedirectResponse
    {
        return redirect()->route('admin.categories.edit', $category);
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name_kk' => ['required', 'string', 'max:255'],
            'name_ru' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'description_kk' => ['nullable', 'string', 'max:500'],
            'description_ru' => ['nullable', 'string', 'max:500'],
            'description_en' => ['nullable', 'string', 'max:500'],
            'color' => ['required', 'string', 'max:7'],
            'icon' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        if ($validated['name_en'] !== $category->name_en) {
            $validated['slug'] = Str::slug($validated['name_en']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.category_updated'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->news()->count() > 0) {
            return back()->with('error', __('admin.category_has_news'));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', __('admin.category_deleted'));
    }
}
