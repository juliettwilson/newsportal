@extends('layouts.admin')

@section('title', __('admin.dashboard'))
@section('header', __('admin.dashboard'))

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('admin.total_news') }}</p>
                    <p class="text-3xl font-bold text-secondary">{{ number_format($stats['total_news']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">{{ $stats['published_news'] }} {{ __('admin.published') }}</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('admin.total_users') }}</p>
                    <p class="text-3xl font-bold text-secondary">{{ number_format($stats['total_users']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('admin.total_views') }}</p>
                    <p class="text-3xl font-bold text-secondary">{{ number_format($stats['total_views']) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('admin.total_comments') }}</p>
                    <p class="text-3xl font-bold text-secondary">{{ number_format($stats['total_comments']) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b flex items-center justify-between">
                <h2 class="font-semibold text-secondary">{{ __('admin.recent_news') }}</h2>
                <a href="{{ route('admin.news.create') }}" class="text-primary hover:underline text-sm">{{ __('admin.add_new') }}</a>
            </div>
            <div class="divide-y">
                @forelse($recentNews as $news)
                    <div class="p-4 flex items-center gap-4 hover:bg-gray-50">
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-16 h-12 rounded-lg object-cover">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-secondary truncate">{{ $news->title }}</h3>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span style="color: {{ $news->category->color }}">{{ $news->category->name }}</span>
                                <span>&bull;</span>
                                <span>{{ $news->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($news->is_published)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">{{ __('admin.published') }}</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">{{ __('admin.draft') }}</span>
                            @endif
                            <a href="{{ route('admin.news.edit', $news) }}" class="text-gray-400 hover:text-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">{{ __('admin.no_news') }}</div>
                @endforelse
            </div>
        </div>


        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h2 class="font-semibold text-secondary">{{ __('admin.categories') }}</h2>
                </div>
                <div class="p-4 space-y-3">
                    @foreach($categories as $category)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full" style="background-color: {{ $category->color }}"></div>
                                <span>{{ $category->name }}</span>
                            </div>
                            <span class="text-gray-500">{{ $category->news_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h2 class="font-semibold text-secondary">{{ __('admin.recent_users') }}</h2>
                </div>
                <div class="divide-y">
                    @foreach($recentUsers as $user)
                        <div class="p-4 flex items-center gap-3">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-secondary truncate">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'author' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                {{ $user->role }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
