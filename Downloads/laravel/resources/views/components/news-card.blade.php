@props(['news', 'featured' => false, 'size' => 'default'])

@php
    $sizes = [
        'small' => 'h-40',
        'default' => 'h-48',
        'large' => 'h-64',
    ];
    $imageHeight = $sizes[$size] ?? $sizes['default'];
@endphp

<article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group {{ $featured ? 'border-2 border-primary' : '' }}">
    <a href="{{ route('news.show', $news->slug) }}" class="block">
        <div class="relative {{ $imageHeight }} overflow-hidden">
            <img src="{{ $news->image_url }}" 
                 alt="{{ $news->title }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            
            @if($news->video_url)
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            @endif

            @if($news->is_featured)
                <span class="absolute top-3 left-3 bg-accent text-white text-xs font-semibold px-2 py-1 rounded">
                    {{ __('news.featured') }}
                </span>
            @endif

            <span class="absolute top-3 right-3 text-xs font-semibold px-2 py-1 rounded text-white"
                  style="background-color: {{ $news->category->color }}">
                {{ $news->category->name }}
            </span>
        </div>
    </a>

    <div class="p-4">
        <a href="{{ route('news.show', $news->slug) }}" class="block">
            <h3 class="font-semibold text-lg text-secondary group-hover:text-primary transition line-clamp-2 mb-2">
                {{ $news->title }}
            </h3>
        </a>

        @if($news->excerpt)
            <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $news->excerpt }}</p>
        @endif

        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <img src="{{ $news->author->avatar_url }}" alt="{{ $news->author->name }}" 
                     class="w-6 h-6 rounded-full object-cover">
                <span>{{ $news->author->name }}</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ number_format($news->views) }}
                </span>
                <span>{{ $news->published_at?->diffForHumans() ?? $news->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</article>
