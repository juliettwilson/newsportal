<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'category_id',
        'author_id',
        'title_kk',
        'title_ru',
        'title_en',
        'excerpt_kk',
        'excerpt_ru',
        'excerpt_en',
        'content_kk',
        'content_ru',
        'content_en',
        'image',
        'video_url',
        'video_type',
        'views',
        'likes',
        'is_featured',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'likes' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('is_approved', true)->whereNull('parent_id');
    }

    public function newsLikes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    // Localized accessors
    public function getTitleAttribute(): string
    {
        $locale = app()->getLocale();
        $field = "title_{$locale}";
        return $this->{$field} ?? $this->title_kk;
    }

    public function getExcerptAttribute(): ?string
    {
        $locale = app()->getLocale();
        $field = "excerpt_{$locale}";
        return $this->{$field} ?? $this->excerpt_kk;
    }

    public function getContentAttribute(): string
    {
        $locale = app()->getLocale();
        $field = "content_{$locale}";
        return $this->{$field} ?? $this->content_kk;
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            return asset('storage/' . $this->image);
        }
        return 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&h=600&fit=crop';
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if ($this->video_type === 'youtube') {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
            if (isset($matches[1])) {
                return "https://www.youtube.com/embed/{$matches[1]}";
            }
        }

        if ($this->video_type === 'vimeo') {
            preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches);
            if (isset($matches[1])) {
                return "https://player.vimeo.com/video/{$matches[1]}";
            }
        }

        return $this->video_url;
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 200));
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title_kk', 'like', "%{$term}%")
              ->orWhere('title_ru', 'like', "%{$term}%")
              ->orWhere('title_en', 'like', "%{$term}%")
              ->orWhere('content_kk', 'like', "%{$term}%")
              ->orWhere('content_ru', 'like', "%{$term}%")
              ->orWhere('content_en', 'like', "%{$term}%");
        });
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views');
    }

    public function scopeRecent($query)
    {
        return $query->orderByDesc('published_at');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->newsLikes()->where('user_id', $user->id)->exists();
    }

    public function isBookmarkedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }
}
