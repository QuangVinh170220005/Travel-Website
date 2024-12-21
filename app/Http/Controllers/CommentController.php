<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $user = auth()->user();
        
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $validated['post_id'],
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'name' => $user->name,
                    'avatar' => $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name)
                ]
            ]
        ]);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['success' => true]);
    }
}
