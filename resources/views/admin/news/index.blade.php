@extends('layouts.admin')

@section('title', __('admin.news'))
@section('header', __('admin.news'))

@section('content')
    <!-- Filters & Actions -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form class="flex flex-wrap items-center gap-4">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="{{ __('admin.search') }}..."
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">{{ __('admin.all_categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">{{ __('admin.all_status') }}</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>{{ __('admin.published') }}</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>{{ __('admin.draft') }}</option>
                </select>

                <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                    {{ __('admin.filter') }}
                </button>
            </form>

            <a href="{{ route('admin.news.create') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ __('admin.add_news') }}
            </a>
        </div>
    </div>

    <!-- News Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.news') }}</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.category') }}</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.author') }}</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.status') }}</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.views') }}</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">{{ __('admin.date') }}</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($news as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-16 h-12 rounded-lg object-cover">
                                <div class="max-w-xs">
                                    <p class="font-medium text-secondary truncate">{{ $item->title_kk }}</p>
                                    @if($item->is_featured)
                                        <span class="text-xs text-yellow-600">{{ __('news.featured') }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs text-white" style="background-color: {{ $item->category->color }}">
                                {{ $item->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <img src="{{ $item->author->avatar_url }}" class="w-6 h-6 rounded-full">
                                <span class="text-sm">{{ $item->author->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->is_published)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">{{ __('admin.published') }}</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full">{{ __('admin.draft') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($item->views) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('d.m.Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.news.toggle-publish', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-green-600" title="{{ $item->is_published ? __('admin.unpublish') : __('admin.publish') }}">
                                        <svg class="w-5 h-5" fill="{{ $item->is_published ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.news.toggle-featured', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-yellow-500" title="{{ __('news.featured') }}">
                                        <svg class="w-5 h-5" fill="{{ $item->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('admin.news.edit', $item) }}" class="p-2 text-gray-400 hover:text-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" 
                                      onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">{{ __('admin.no_news') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $news->withQueryString()->links() }}
    </div>
@endsection
