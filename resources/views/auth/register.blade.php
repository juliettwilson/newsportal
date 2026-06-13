@extends('layouts.app')

@section('title', __('nav.register') . ' - ' . __('site.name'))

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center py-12">
        <div class="max-w-lg w-full mx-4">
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-secondary">{{ __('auth.register_title') }}</h1>
                    <p class="text-gray-500 mt-2">{{ __('auth.register_subtitle') }}</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf


                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.name') }} *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.email') }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="email@example.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.phone') }}</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('phone') border-red-500 @enderror"
                               placeholder="+7 (777) 123-45-67">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.birth_date') }}</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.password') }} *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="********">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.confirm_password') }} *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="********">
                    </div>


                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" name="terms" required
                                   class="rounded border-gray-300 text-primary focus:ring-primary mt-1 @error('terms') border-red-500 @enderror">
                            <span class="ml-2 text-sm text-gray-600">{{ __('auth.terms_agree') }}</span>
                        </label>
                        @error('terms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        {{ __('auth.register_button') }}
                    </button>
                </form>


                <p class="text-center text-gray-600 mt-6">
                    {{ __('auth.have_account') }}
                    <a href="{{ route('login') }}" class="text-primary hover:underline">{{ __('auth.login_link') }}</a>
                </p>
            </div>
        </div>
    </section>
@endsection
