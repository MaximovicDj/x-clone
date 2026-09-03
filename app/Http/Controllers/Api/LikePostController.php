<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, Request $request)
    {
        $liked = auth()->user()->likedPosts()->toggle($post->id);
        return response()->json([
            'status' => true,
            'liked' => !empty($liked['attached']),
            'likedCount' => $post->likes->count(),
        ]);
    }
}
