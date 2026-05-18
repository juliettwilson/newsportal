<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            
            // Multi-language titles
            $table->string('title_kk');
            $table->string('title_ru');
            $table->string('title_en');
            
            // Multi-language excerpts
            $table->text('excerpt_kk')->nullable();
            $table->text('excerpt_ru')->nullable();
            $table->text('excerpt_en')->nullable();
            
            // Multi-language content
            $table->longText('content_kk');
            $table->longText('content_ru');
            $table->longText('content_en');
            
            // Media
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->enum('video_type', ['youtube', 'vimeo', 'local'])->nullable();
            
            // Meta
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['is_published', 'published_at']);
            $table->index('is_featured');
            // $table->fullText(['title_kk', 'title_ru', 'title_en', 'content_kk', 'content_ru', 'content_en']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
