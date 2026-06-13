@extends('layouts.admin')

@section('title', __('admin.edit_category'))
@section('header', __('admin.edit_category') . ': ' . $category->name_kk)

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white rounded-xl shadow-sm p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.name_kk') }} *</label>
                        <input type="text" name="name_kk" value="{{ old('name_kk', $category->name_kk) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name_kk') border-red-500 @enderror">
                        @error('name_kk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.name_ru') }} *</label>
                        <input type="text" name="name_ru" value="{{ old('name_ru', $category->name_ru) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name_ru') border-red-500 @enderror">
                        @error('name_ru')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.name_en') }} *</label>
                        <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name_en') border-red-500 @enderror">
                        @error('name_en')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.description_kk') }}</label>
                        <textarea name="description_kk" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description_kk', $category->description_kk) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.description_ru') }}</label>
                        <textarea name="description_ru" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description_ru', $category->description_ru) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.description_en') }}</label>
                        <textarea name="description_en" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description_en', $category->description_en) }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.color') }} *</label>
                        <input type="color" name="color" value="{{ old('color', $category->color) }}" required
                               class="w-full h-10 border border-gray-300 rounded-lg cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('admin.sort_order') }}</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm">{{ __('admin.active') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    {{ __('admin.update') }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                    {{ __('admin.cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection
