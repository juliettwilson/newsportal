@extends('layouts.app')

@section('title', __('site.name') . ' - ' . __('site.tagline'))

@section('content')

    <div class="bg-red-600 text-white py-2 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-4">
            <span class="flex-shrink-0 bg-white text-red-600 px-3 py-1 rounded text-sm font-bold animate-pulse">
                {{ __('news.breaking') }}
            </span>
            <div class="overflow-hidden whitespace-nowrap">
                <div class="inline-block animate-marquee">
                    @if(isset($breakingNews) && $breakingNews->count() > 0)
                        @foreach($breakingNews as $breaking)
                            <span class="mx-8">{{ $breaking->title }}</span>
                        @endforeach
                    @else
                        <span class="mx-8">Қазақстан Президенті халықаралық форумға қатысты</span>
                        <span class="mx-8">Алматыда жаңа IT хаб ашылды</span>
                        <span class="mx-8">Ұлттық құрама әлем чемпионатына дайындалуда</span>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @if(isset($featuredNews) && $featuredNews->count() > 0)
        <section class="bg-gradient-to-br from-primary via-blue-600 to-secondary py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    @if($featuredNews->first())
                        @php $main = $featuredNews->first(); @endphp
                        <a href="{{ route('news.show', $main->slug) }}" class="relative rounded-2xl overflow-hidden h-96 group">
                            <img src="{{ $main->image_url }}" alt="{{ $main->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <span class="inline-block text-xs font-semibold px-3 py-1 rounded mb-3 text-white"
                                      style="background-color: {{ $main->category->color }}">
                                    {{ $main->category->name }}
                                </span>
                                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 line-clamp-2">{{ $main->title }}</h2>
                                <p class="text-gray-200 line-clamp-2 mb-3">{{ $main->excerpt }}</p>
                                <div class="flex items-center gap-4 text-sm text-gray-300">
                                    <span>{{ $main->author->name }}</span>
                                    <span>{{ $main->published_at?->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endif


                    <div class="grid grid-cols-2 gap-4">
                        @foreach($featuredNews->skip(1)->take(4) as $item)
                            <a href="{{ route('news.show', $item->slug) }}" class="relative rounded-xl overflow-hidden h-44 group">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-3">
                                    <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded mb-1 text-white"
                                          style="background-color: {{ $item->category->color }}">
                                        {{ $item->category->name }}
                                    </span>
                                    <h3 class="text-sm font-semibold text-white line-clamp-2">{{ $item->title }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @else

        <section class="bg-gradient-to-br from-primary via-blue-600 to-secondary py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <span class="inline-block bg-accent text-white text-sm font-semibold px-4 py-1 rounded-full mb-4">
                            {{ __('news.featured') }}
                        </span>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                            Қазақстанның жетекші жаңалықтар порталы
                        </h1>
                        <p class="text-xl text-blue-100 mb-6">
                            Саясат, экономика, спорт, технология және мәдениет саласындағы ең соңғы жаңалықтар
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#latest" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                                Соңғы жаңалықтар
                            </a>
                            <a href="#categories" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/10 transition">
                                Санаттар
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative rounded-xl overflow-hidden h-44 bg-white/10 backdrop-blur">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Саясат</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative rounded-xl overflow-hidden h-44 bg-white/10 backdrop-blur">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Экономика</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative rounded-xl overflow-hidden h-44 bg-white/10 backdrop-blur">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Спорт</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative rounded-xl overflow-hidden h-44 bg-white/10 backdrop-blur">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Технология</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="py-8 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">1,250+</div>
                    <div class="text-gray-600 text-sm">{{ __('stats.articles') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">50K+</div>
                    <div class="text-gray-600 text-sm">{{ __('stats.readers') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">25+</div>
                    <div class="text-gray-600 text-sm">{{ __('stats.journalists') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary mb-1">24/7</div>
                    <div class="text-gray-600 text-sm">{{ __('stats.coverage') }}</div>
                </div>
            </div>
        </div>
    </section>

    <section id="latest" class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8 bg-primary rounded-full"></div>
                    <h2 class="text-2xl font-bold text-secondary">{{ __('news.latest') }}</h2>
                </div>
                <a href="{{ route('news.index') }}" class="text-primary hover:underline flex items-center gap-1">
                    {{ __('news.view_all') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @if(isset($latestNews) && $latestNews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestNews as $news)
                        <x-news-card :news="$news" />
                    @endforeach
                </div>
            @else

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for($i = 1; $i <= 6; $i++)
                        <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="absolute top-3 right-3 text-xs font-semibold px-2 py-1 rounded text-white bg-primary">
                                    {{ ['Саясат', 'Экономика', 'Спорт', 'Технология', 'Мәдениет', 'Қоғам'][$i - 1] }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg text-secondary group-hover:text-primary transition line-clamp-2 mb-2">
                                    {{ ['Қазақстан Президенті халықаралық саммитке қатысты', 'Ұлттық валюта курсы тұрақтады', 'Футбол құрамасы жеңіске жетті', 'Жаңа технологиялық стартап іске қосылды', 'Ұлттық мұражайда көрме ашылды', 'Білім беру саласындағы реформалар'][$i - 1] }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                    Бұл мақалада {{ ['саяси оқиғалар', 'экономикалық жаңалықтар', 'спорттық жетістіктер', 'технологиялық инновациялар', 'мәдени оқиғалар', 'қоғамдық өзгерістер'][$i - 1] }} туралы толық ақпарат берілген.
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>Редакция</span>
                                    <span>{{ now()->subDays($i)->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endfor
                </div>
            @endif
        </div>
    </section>


    <section id="categories" class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-secondary mb-2">{{ __('nav.categories') }}</h2>
                <p class="text-gray-600">Сізді қызықтыратын санатты таңдаңыз</p>
            </div>
            @if(isset($categories) && $categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('news.category', $category->slug) }}"
                           class="relative rounded-xl overflow-hidden h-40 group"
                           style="background: linear-gradient(135deg, {{ $category->color }}, {{ $category->color }}dd)">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition"></div>
                            <div class="relative h-full flex flex-col justify-center items-center text-white p-6">
                                <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                                <p class="text-white/80 text-sm">{{ $category->published_news_count }} {{ __('news.articles') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @php
                        $staticCategories = [
                            ['name' => 'Саясат', 'slug' => 'politics', 'color' => '#1e40af', 'count' => 156],
                            ['name' => 'Экономика', 'slug' => 'economy', 'color' => '#15803d', 'count' => 203],
                            ['name' => 'Спорт', 'slug' => 'sport', 'color' => '#b91c1c', 'count' => 187],
                            ['name' => 'Технология', 'slug' => 'technology', 'color' => '#7c3aed', 'count' => 124],
                            ['name' => 'Мәдениет', 'slug' => 'culture', 'color' => '#ea580c', 'count' => 98],
                            ['name' => 'Қоғам', 'slug' => 'society', 'color' => '#0891b2', 'count' => 167],
                            ['name' => 'Денсаулық', 'slug' => 'health', 'color' => '#16a34a', 'count' => 89],
                            ['name' => 'Білім', 'slug' => 'education', 'color' => '#9333ea', 'count' => 112],
                        ];
                    @endphp
                    @foreach($staticCategories as $cat)
                        <a href="{{ route('news.category', $cat['slug']) }}"
                           class="relative rounded-xl overflow-hidden h-40 group"
                           style="background: linear-gradient(135deg, {{ $cat['color'] }}, {{ $cat['color'] }}dd)">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition"></div>
                            <div class="relative h-full flex flex-col justify-center items-center text-white p-6">
                                <h3 class="text-xl font-bold mb-2">{{ $cat['name'] }}</h3>
                                <p class="text-white/80 text-sm">{{ $cat['count'] }} {{ __('news.articles') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @foreach($categories as $category)
        @if(isset($categoryNews[$category->slug]) && $categoryNews[$category->slug]->count() > 0)
            <section class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-8 rounded-full" style="background-color: {{ $category->color }}"></div>
                            <h2 class="text-2xl font-bold text-secondary">{{ $category->name }}</h2>
                        </div>
                        <a href="{{ route('news.category', $category->slug) }}" class="text-primary hover:underline flex items-center gap-1">
                            {{ __('news.view_all') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($categoryNews[$category->slug] as $news)
                            <x-news-card :news="$news" size="small" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach


    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-accent rounded-full"></div>
                <h2 class="text-2xl font-bold text-secondary">{{ __('news.popular') }}</h2>
            </div>
            @if(isset($popularNews) && $popularNews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach($popularNews as $index => $news)
                        <a href="{{ route('news.show', $news->slug) }}" class="flex items-start gap-4 bg-white rounded-xl p-4 hover:shadow-md transition">
                            <span class="text-4xl font-bold text-gray-200">{{ $index + 1 }}</span>
                            <div>
                                <h3 class="font-semibold text-secondary line-clamp-2 mb-1">{{ $news->title }}</h3>
                                <span class="text-sm text-gray-500">{{ number_format($news->views) }} {{ __('news.views') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    @php
                        $staticPopular = [
                            ['title' => 'Қазақстан Президенті БҰҰ Бас Ассамблеясында сөз сөйледі', 'views' => 15420],
                            ['title' => 'Алматыда халықаралық IT форум өтті', 'views' => 12350],
                            ['title' => 'Ұлттық футбол құрамасы әлем чемпионатына жолдама алды', 'views' => 11890],
                            ['title' => 'Қазақстандық ғалымдар жаңа ашу жасады', 'views' => 9870],
                            ['title' => 'Астанада жаңа мәдениет орталығы ашылды', 'views' => 8540],
                        ];
                    @endphp
                    @foreach($staticPopular as $index => $item)
                        <div class="flex items-start gap-4 bg-white rounded-xl p-4 hover:shadow-md transition cursor-pointer">
                            <span class="text-4xl font-bold text-gray-200">{{ $index + 1 }}</span>
                            <div>
                                <h3 class="font-semibold text-secondary line-clamp-2 mb-1">{{ $item['title'] }}</h3>
                                <span class="text-sm text-gray-500">{{ number_format($item['views']) }} {{ __('news.views') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>


    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-red-500 rounded-full"></div>
                <h2 class="text-2xl font-bold text-secondary">{{ __('news.video') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $videoNews = [
                        ['title' => 'Астана қаласының даму перспективалары', 'duration' => '12:34', 'views' => 8500],
                        ['title' => 'Қазақстан туризм саласының жаңалықтары', 'duration' => '08:45', 'views' => 6200],
                        ['title' => 'Инновациялық технологиялар көрмесі', 'duration' => '15:20', 'views' => 5800],
                    ];
                @endphp
                @foreach($videoNews as $video)
                    <div class="relative rounded-xl overflow-hidden bg-gray-900 aspect-video group cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/30 to-secondary/30"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                <svg class="w-8 h-8 text-red-500 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                            <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded mb-2">{{ $video['duration'] }}</span>
                            <h3 class="text-white font-semibold line-clamp-2">{{ $video['title'] }}</h3>
                            <span class="text-gray-300 text-sm">{{ number_format($video['views']) }} {{ __('news.views') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="py-16 bg-gradient-to-br from-primary to-blue-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">{{ __('newsletter.title') }}</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                Ең соңғы жаңалықтарды бірінші болып біліңіз. Күнделікті жаңалықтар жіберіліп тұрады.
            </p>
            <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto">
                <input type="email" placeholder="Email мекенжайыңыз"
                       class="flex-1 px-6 py-3 rounded-lg focus:ring-2 focus:ring-accent focus:outline-none">
                <button type="submit" class="bg-accent text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-600 transition">
                    {{ __('newsletter.subscribe') }}
                </button>
            </form>
        </div>
    </section>


    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-primary font-semibold mb-2 block">{{ __('about.subtitle') }}</span>
                    <h2 class="text-3xl font-bold text-secondary mb-4">{{ __('about.title') }}</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ __('site.name') }} - Қазақстанның жетекші жаңалықтар порталы. Біз 2010 жылдан бері
                        оқырмандарымызға сапалы және объективті ақпарат береміз. Біздің команда тәжірибелі
                        журналистер мен редакторлардан құралған.
                    </p>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Тәулік бойы жаңартылатын контент</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Тексерілген және сенімді ақпарат</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Көп тілді қолдау (қазақша, орысша, ағылшынша)</span>
                        </li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-2 text-primary font-semibold hover:underline">
                        {{ __('about.learn_more') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-100 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">15+</div>
                        <div class="text-gray-600">жыл тәжірибе</div>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">50K+</div>
                        <div class="text-gray-600">күнделікті оқырман</div>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">25+</div>
                        <div class="text-gray-600">тәжірибелі журналист</div>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">8</div>
                        <div class="text-gray-600">санат бойынша жаңалықтар</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-500 text-center mb-8">{{ __('partners.title') }}</h2>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                @for($i = 1; $i <= 5; $i++)
                    <div class="text-gray-400 font-bold text-xl opacity-50 hover:opacity-100 transition">
                        Partner {{ $i }}
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 30s linear infinite;
    }
</style>
@endpush
