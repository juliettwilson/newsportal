@extends('layouts.admin')

@section('title', __('admin.add_news'))
@section('header', __('admin.add_news'))

@section('content')
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Titles -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">{{ __('admin.titles') }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.title_kk') }} *</label>
                            <input type="text" name="title_kk" value="{{ old('title_kk') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title_kk') border-red-500 @enderror">
                            @error('title_kk')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.title_ru') }} *</label>
                            <input type="text" name="title_ru" value="{{ old('title_ru') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title_ru') border-red-500 @enderror">
                            @error('title_ru')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.title_en') }} *</label>
                            <input type="text" name="title_en" value="{{ old('title_en') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title_en') border-red-500 @enderror">
                            @error('title_en')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Excerpts -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">{{ __('admin.excerpts') }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.excerpt_kk') }}</label>
                            <textarea name="excerpt_kk" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('excerpt_kk') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.excerpt_ru') }}</label>
                            <textarea name="excerpt_ru" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('excerpt_ru') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.excerpt_en') }}</label>
                            <textarea name="excerpt_en" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('excerpt_en') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">{{ __('admin.content') }}</h2>
                    
                    <div x-data="{ tab: 'kk' }">
                        <div class="flex border-b mb-4">
                            <button type="button" @click="tab = 'kk'" :class="tab === 'kk' ? 'border-primary text-primary' : 'border-transparent text-gray-500'" class="px-4 py-2 border-b-2 font-medium transition">Қазақша</button>
                            <button type="button" @click="tab = 'ru'" :class="tab === 'ru' ? 'border-primary text-primary' : 'border-transparent text-gray-500'" class="px-4 py-2 border-b-2 font-medium transition">Русский</button>
                            <button type="button" @click="tab = 'en'" :class="tab === 'en' ? 'border-primary text-primary' : 'border-transparent text-gray-500'" class="px-4 py-2 border-b-2 font-medium transition">English</button>
                        </div>

                        <div x-show="tab === 'kk'">
                            <textarea name="content_kk" rows="10" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content_kk') border-red-500 @enderror">{{ old('content_kk') }}</textarea>
                            @error('content_kk')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="tab === 'ru'">
                            <textarea name="content_ru" rows="10" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content_ru') border-red-500 @enderror">{{ old('content_ru') }}</textarea>
                            @error('content_ru')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="tab === 'en'">
                            <textarea name="content_en" rows="10" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content_en') border-red-500 @enderror">{{ old('content_en') }}</textarea>
                            @error('content_en')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">{{ __('admin.publish_settings') }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.category') }} *</label>
                            <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">{{ __('admin.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <label class="flex items-center">
                                <input type="hidden" name="is_published" value="0">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span class="ml-2 text-sm">{{ __('admin.publish_now') }}</span>
                            </label>

                            <label class="flex items-center">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span class="ml-2 text-sm">{{ __('news.featured') }}</span>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.publish_date') }}</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">{{ __('admin.media') }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.image') }}</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">{{ __('admin.max_size') }}: 5MB</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.video_url') }}</label>
                            <input type="url" name="video_url" value="{{ old('video_url') }}"
                                   placeholder="https://youtube.com/watch?v=..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">YouTube, Vimeo</p>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="font-semibold text-secondary mb-4">SEO</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        {{ __('admin.save') }}
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                        {{ __('admin.cancel') }}
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
