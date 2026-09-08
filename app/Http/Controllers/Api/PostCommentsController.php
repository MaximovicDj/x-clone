<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use Inertia\Inertia;

class PostCommentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->paginate(5);

        return response()->json([
            'comments' => CommentResource::collection($comments->items()),
            'next_page_url' => $comments->nextPageUrl(),
        ]);
    }
}
