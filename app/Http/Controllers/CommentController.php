<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * @param CommentRequest $request
     * @param Post $post
     * @return void
     */
    public function store(CommentRequest $request, Post $post): void
    {
        auth()->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $post->id
        ]);
    }

    public function update(Comment $comment, UpdateCommentRequest $request): void
    {
        $this->authorize('update', $comment);
        $comment->update([
            'comment' => $request->comment
        ]);
    }

    /**
     * @param Comment $comment
     * @return void
     */
    public function destroy(Comment $comment): void
    {
        $this->authorize('delete', $comment);
        $comment->delete();
    }
}
