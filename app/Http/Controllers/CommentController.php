<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);

        // Load relationships
        $comment->load(['user:id,full_name,avatar']);

        return response()->json([
            'message' => 'Bình luận đã được thêm thành công',
            'data' => $comment
        ]);
    }
}
?>