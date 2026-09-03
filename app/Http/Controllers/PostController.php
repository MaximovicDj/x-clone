<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * @param PostService $postService
     */
    public function __construct(protected PostService $postService){}

    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
                'posts' => Inertia::scroll(fn () => PostResource::collection(
                    Post::getPosts()->paginate(10)
                )),
                'tags' => TagResource::collection(Tag::select('id', 'name')->get())
            ]);
    }

    /**
     * @param CreatePostRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $this->postService->store(
            $request->validated(),
            $request->user()
        );
        return redirect()->back()
            ->with('success', 'Post created');
    }

    /**
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
    {
        $this->authorize('view', $post);

        return Inertia::render('Post/UpdatePost', [
            'post' => new PostResource($post->load('tags', 'images', 'user')),
            'tags' => TagResource::collection(Tag::select('id', 'name')->get())
        ]);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $this->postService->update(
            $request->validated(),
            $post
        );

        return redirect()->back()
            ->with('success', 'Post updated');
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $this->postService->delete(
            $post
        );

        return redirect()->back()
            ->with('success', 'Post deleted');
    }
}
