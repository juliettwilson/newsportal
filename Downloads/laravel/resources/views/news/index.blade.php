@extends('layouts.app')

@section('title', __('news.all_news') . ' - ' . __('site.name'))

@section('content')
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-secondary mb-2">{{ __('news.all_news') }}</h1>
                    <p class="text-gray-600">{{ __('news.browse_all') }}</p>
                </div>
                
                <!-- Filter & Sort -->
                <div class="flex items-center gap-4 mt-4 md:mt-0">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm hover:border-gray-400 transition">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            {{ __('news.filter') }}
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10">
                            <a href="?sort=latest" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('news.sort_latest') }}</a>
                            <a href="?sort=popular" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('news.sort_popular') }}</a>
                            <a href="?sort=oldest" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('news.sort_oldest') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Quick Filter -->
            <div class="flex flex-wrap gap-3 mb-8">
                <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
                    {{ __('news.all') }}
                </a>
                @foreach(\App\Models\Category::active()->ordered()->get() as $cat)
                    <a href="{{ route('news.index', ['category' => $cat->slug]) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition"
                       style="{{ request('category') == $cat->slug ? 'background-color: ' . $cat->color . '; color: white;' : 'background-color: #f3f4f6; color: #374151;' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- News Grid -->
            @if(isset($news) && $news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($news as $item)
                        <x-news-card :news="$item" />
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $news->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('news.no_news') }}</h3>
                    <p class="text-gray-500 mb-6">{{ __('news.no_news_description') }}</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        {{ __('nav.home') }}
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 bg-gradient-to-br from-primary to-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-4">{{ __('newsletter.title') }}</h2>
            <p class="text-blue-100 mb-6">
                Ең соңғы жаңалықтарды бірінші болып біліңіз.
            </p>
            <form class="flex flex-col sm:flex-row gap-3 justify-center max-w-md mx-auto">
                <input type="email" placeholder="{{ __('newsletter.placeholder') }}" 
                       class="flex-1 px-4 py-3 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none">
                <button type="submit" class="bg-accent text-white px-6 py-3 rounded-lg font-semibold hover:bg-amber-600 transition">
                    {{ __('newsletter.subscribe') }}
                </button>
            </form>
        </div>
    </section>
@endsection
