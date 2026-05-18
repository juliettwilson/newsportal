<nav x-data="{ open: false, langOpen: false }" class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-secondary">{{ __('site.name') }}</span>
                </a>
            </div>


            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition {{ request()->routeIs('home') ? 'text-primary font-medium' : '' }}">
                    {{ __('nav.home') }}
                </a>
                @foreach(\App\Models\Category::active()->ordered()->get() as $cat)
                    <a href="{{ route('news.category', $cat->slug) }}"
                       class="text-gray-600 hover:text-primary transition {{ request()->is('category/'.$cat->slug) ? 'text-primary font-medium' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>


            <div class="flex items-center gap-4">

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1 text-gray-600 hover:text-primary">
                        <span class="uppercase font-medium">{{ app()->getLocale() }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg py-1 z-50">
                        <a href="{{ route('locale.switch', 'kk') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'kk' ? 'bg-gray-100 font-medium' : '' }}">
                            Қазақша
                        </a>
                        <a href="{{ route('locale.switch', 'ru') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'ru' ? 'bg-gray-100 font-medium' : '' }}">
                            Русский
                        </a>
                        <a href="{{ route('locale.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'bg-gray-100 font-medium' : '' }}">
                            English
                        </a>
                    </div>
                </div>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2">
                            <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover">
                            <span class="hidden sm:block text-sm font-medium">{{ auth()->user()->name }}</span>
                        </button>
                        <div x-show="open" @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    {{ __('nav.admin') }}
                                </a>
                            @endif
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                {{ __('nav.profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-red-600">
                                    {{ __('nav.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary">{{ __('nav.login') }}</a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        {{ __('nav.register') }}
                    </a>
                @endauth


                <button @click="open = !open" class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>


        <div x-show="open" x-transition class="md:hidden pb-4">
            <a href="{{ route('home') }}" class="block py-2 text-gray-600 hover:text-primary">{{ __('nav.home') }}</a>
            @foreach(\App\Models\Category::active()->ordered()->get() as $cat)
                <a href="{{ route('news.category', $cat->slug) }}" class="block py-2 text-gray-600 hover:text-primary">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
