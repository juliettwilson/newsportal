<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Bookmark;
use Illuminate\Http\JsonResponse;

class InteractionController extends Controller
{
    public function likeNews(News $news): JsonResponse
    {
        $user = auth()->user();

        $existing = $news->newsLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $news->decrement('likes');
            $liked = false;
        } else {
            $news->newsLikes()->create(['user_id' => $user->id]);
            $news->increment('likes');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes' => $news->fresh()->likes,
        ]);
    }

    public function bookmarkNews(News $news): JsonResponse
    {
        $user = auth()->user();

        $existing = $news->bookmarks()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $bookmarked = false;
        } else {
            $news->bookmarks()->create(['user_id' => $user->id]);
            $bookmarked = true;
        }

        return response()->json([
            'success' => true,
            'bookmarked' => $bookmarked,
        ]);
    }
}
