@extends('layouts.app')

@section('title', $news->title . ' - ' . __('site.name'))
@section('description', $news->excerpt)

@section('content')
    <article class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-primary">{{ __('nav.home') }}</a>
                <span>/</span>
                <a href="{{ route('news.category', $news->category->slug) }}" class="hover:text-primary">{{ $news->category->name }}</a>
                <span>/</span>
                <span class="text-gray-700">{{ Str::limit($news->title, 40) }}</span>
            </nav>


            <div class="flex items-center gap-4 mb-4">
                <span class="text-sm font-semibold px-3 py-1 rounded text-white"
                      style="background-color: {{ $news->category->color }}">
                    {{ $news->category->name }}
                </span>
                <span class="text-gray-500">{{ $news->published_at?->format('d.m.Y H:i') }}</span>
                <span class="text-gray-500">{{ $news->reading_time }} {{ __('news.min_read') }}</span>
            </div>


            <h1 class="text-3xl md:text-4xl font-bold text-secondary mb-6">{{ $news->title }}</h1>


            <div class="flex items-center gap-4 mb-8 pb-8 border-b">
                <img src="{{ $news->author->avatar_url }}" alt="{{ $news->author->name }}"
                     class="w-12 h-12 rounded-full object-cover">
                <div>
                    <p class="font-semibold text-secondary">{{ $news->author->name }}</p>
                    <p class="text-sm text-gray-500">{{ $news->author->bio ?? __('news.author') }}</p>
                </div>
            </div>


            @if($news->video_url)
                <div class="aspect-video rounded-xl overflow-hidden mb-8">
                    <iframe src="{{ $news->video_embed_url }}"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            @else
                <img src="{{ $news->image_url }}" alt="{{ $news->title }}"
                     class="w-full h-96 object-cover rounded-xl mb-8">
            @endif


            <div class="prose prose-lg max-w-none mb-8">
                {!! nl2br(e($news->content)) !!}
            </div>


            <div class="flex items-center justify-between py-6 border-t border-b mb-8">
                <div class="flex items-center gap-6">
                    @auth
                        <button onclick="likeNews({{ $news->id }})"
                                id="like-btn"
                                class="flex items-center gap-2 {{ $isLiked ? 'text-red-500' : 'text-gray-500' }} hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="likes-count">{{ $news->likes }}</span>
                        </button>
                        <button onclick="bookmarkNews({{ $news->id }})"
                                id="bookmark-btn"
                                class="flex items-center gap-2 {{ $isBookmarked ? 'text-primary' : 'text-gray-500' }} hover:text-primary transition">
                            <svg class="w-6 h-6" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            {{ __('news.bookmark') }}
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $news->likes }}</span>
                        </a>
                    @endauth
                    <span class="flex items-center gap-2 text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ number_format($news->views) }} {{ __('news.views') }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-gray-500">{{ __('news.share') }}:</span>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}"
                       target="_blank" class="text-gray-400 hover:text-blue-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank" class="text-gray-400 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>

            <section id="comments" class="mb-12">
                <h2 class="text-2xl font-bold text-secondary mb-6">
                    {{ __('comments.title') }} ({{ $news->approvedComments->count() }})
                </h2>

                @auth
                    <form action="{{ route('comments.store', $news) }}" method="POST" class="mb-8">
                        @csrf
                        <textarea name="content" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                                  placeholder="{{ __('comments.placeholder') }}"></textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="mt-2 bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ __('comments.submit') }}
                        </button>
                    </form>
                @else
                    <div class="bg-gray-100 rounded-lg p-6 text-center mb-8">
                        <p class="text-gray-600 mb-3">{{ __('comments.login_required') }}</p>
                        <a href="{{ route('login') }}" class="text-primary hover:underline">{{ __('nav.login') }}</a>
                    </div>
                @endauth

                <div class="space-y-6">
                    @foreach($news->approvedComments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <img src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}"
                                     class="w-10 h-10 rounded-full object-cover">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <span class="font-semibold text-secondary">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            </div>

                            @if($comment->replies->count() > 0)
                                <div class="ml-12 mt-4 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="bg-white rounded-lg p-3">
                                            <div class="flex items-start gap-3">
                                                <img src="{{ $reply->user->avatar_url }}" alt="{{ $reply->user->name }}"
                                                     class="w-8 h-8 rounded-full object-cover">
                                                <div>
                                                    <span class="font-semibold text-secondary">{{ $reply->user->name }}</span>
                                                    <span class="text-sm text-gray-500 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                                    <p class="text-gray-700 mt-1">{{ $reply->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        @if($relatedNews->count() > 0)
            <section class="bg-gray-100 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-secondary mb-8">{{ __('news.related') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedNews as $related)
                            <x-news-card :news="$related" size="small" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
@endsection

@push('scripts')
<script>
    function likeNews(newsId) {
        fetch(`/news/${newsId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const btn = document.getElementById('like-btn');
            const count = document.getElementById('likes-count');
            count.textContent = data.likes;
            if (data.liked) {
                btn.classList.add('text-red-500');
                btn.classList.remove('text-gray-500');
                btn.querySelector('svg').setAttribute('fill', 'currentColor');
            } else {
                btn.classList.remove('text-red-500');
                btn.classList.add('text-gray-500');
                btn.querySelector('svg').setAttribute('fill', 'none');
            }
        });
    }

    function bookmarkNews(newsId) {
        fetch(`/news/${newsId}/bookmark`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const btn = document.getElementById('bookmark-btn');
            if (data.bookmarked) {
                btn.classList.add('text-primary');
                btn.classList.remove('text-gray-500');
                btn.querySelector('svg').setAttribute('fill', 'currentColor');
            } else {
                btn.classList.remove('text-primary');
                btn.classList.add('text-gray-500');
                btn.querySelector('svg').setAttribute('fill', 'none');
            }
        });
    }
</script>
@endpush
