@extends('layouts.app')

@section('title', __('nav.profile') . ' - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50/50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ __('profile.title') }}</h1>
            <p class="mt-2 text-sm text-gray-500">{{ __('profile.subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Profile Overview -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="h-24 bg-gradient-to-r from-primary to-blue-500"></div>
                    <div class="px-6 pb-6">
                        <div class="relative -mt-12 mb-4">
                            <div class="inline-block p-1.5 bg-white rounded-2xl shadow-xl">
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" 
                                     class="w-24 h-24 rounded-xl object-cover">
                            </div>
                            <div class="absolute bottom-2 left-20">
                                <span class="flex h-4 w-4">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-green-500 border-2 border-white"></span>
                                </span>
                            </div>
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500 mb-6">{{ auth()->user()->email }}</p>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-xs font-medium text-gray-500 uppercase">{{ __('profile.status') }}</span>
                                <span class="px-2.5 py-1 text-xs font-bold rounded-lg {{ auth()->user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ strtoupper(auth()->user()->role) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-xs font-medium text-gray-500 uppercase">{{ __('profile.registered') }}</span>
                                <span class="text-sm font-semibold text-gray-700">{{ auth()->user()->created_at->format('d.m.Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-primary rounded-3xl p-6 text-white shadow-xl shadow-blue-200">
                    <h3 class="text-lg font-bold mb-2">{{ __('profile.need_help') }}</h3>
                    <p class="text-blue-100 text-sm mb-4">{{ __('profile.support_text') }}</p>
                    <a href="mailto:support@newsportal.kz" class="inline-flex items-center text-sm font-bold bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl transition">
                        {{ __('profile.contact_us') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Column: Settings -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Personal Info Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-bold text-gray-900">{{ __('profile.personal_info') }}</h3>
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="text-sm font-bold text-gray-700 mb-2 block">{{ __('profile.full_name') }}</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition">
                                    @error('name') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="text-sm font-bold text-gray-700 mb-2 block">{{ __('profile.phone') }}</label>
                                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+7 (___) ___-__-__"
                                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition">
                                    @error('phone') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="text-sm font-bold text-gray-700 mb-2 block">{{ __('profile.birth_date') }}</label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date', auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '') }}"
                                           class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition">
                                    @error('birth_date') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="text-sm font-bold text-gray-700 mb-2 block">{{ __('profile.bio') }}</label>
                                    <textarea name="bio" rows="4" placeholder="{{ __('profile.bio_placeholder') }}"
                                              class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition">{{ old('bio', auth()->user()->bio) }}</textarea>
                                </div>
                            </div>

                            <div class="flex justify-end mt-8">
                                <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] transition shadow-xl shadow-blue-200">
                                    {{ __('profile.save_changes') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
