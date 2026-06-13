<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function store(Request $request, News $news): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $comment = $news->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_approved' => true, // Auto-approve for now
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'comment' => $comment->load('user'),
            ]);
        }

        return back()->with('success', __('comments.created'));
    }

    public function destroy(Comment $comment): RedirectResponse|JsonResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', __('comments.deleted'));
    }

    public function like(Comment $comment): JsonResponse
    {
        $user = auth()->user();

        $existing = $comment->commentLikes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $comment->decrement('likes');
            $liked = false;
        } else {
            $comment->commentLikes()->create(['user_id' => $user->id]);
            $comment->increment('likes');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes' => $comment->fresh()->likes,
        ]);
    }
}
