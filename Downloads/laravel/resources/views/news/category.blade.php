@extends('layouts.app')

@section('title', $category->name . ' - ' . __('site.name'))

@section('content')
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center"
                     style="background-color: {{ $category->color }}20">
                    <div class="w-8 h-8 rounded-lg" style="background-color: {{ $category->color }}"></div>
                </div>
                <h1 class="text-3xl font-bold text-secondary mb-2">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-gray-600 max-w-2xl mx-auto">{{ $category->description }}</p>
                @endif
                <p class="text-gray-500 mt-2">{{ $news->total() }} {{ __('news.articles') }}</p>
            </div>

            <!-- News Grid -->
            @if($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($news as $item)
                        <x-news-card :news="$item" />
                    @endforeach
                </div>

                {{ $news->links() }}
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <p class="text-gray-500">{{ __('news.no_news') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
