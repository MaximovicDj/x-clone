<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Throwable;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO refactor PostController
        //  make Service Controller where you put logic
        $posts = Post::with('user', 'images', 'tags')->latest()->get();
        return Inertia::render('Dashboard',
            [
                'posts' => PostResource::collection($posts),
                'tags' => TagResource::collection(Tag::all())
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function store(CreatePostRequest $request)
    {
        DB::transaction(function () use ($request) {
            $post = Post::create([
                'content' => $request->input('content'),
                'user_id' => auth()->id()
            ]);
            if($request->hasFile('images'))
            {
                foreach($request->file('images') as $image)
                {
                    $path = $image->store('posts', 'public');
                    $post->images()->create([
                        'path_name' => $path
                    ]);
                }
            }
            if($request->tags)
            {
                $post->tags()->attach(
                    collect($request->tags)->pluck('id')
                );
            }
        });

        return redirect()->back()->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        $tags = Tag::all();
        return Inertia::render('Post/UpdatePost', [
            'post' => new PostResource($post->load('tags', 'images', 'user')),
            'tags' => TagResource::collection($tags)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        DB::transaction(function () use ($request, $post) {
            $post->update($request->validated());
            $post->tags()->sync(
                collect($request->tags)->pluck('id')
            );


            if($request->existingImages)
            {
                $existingImages = collect($request->existingImages)->pluck('id');
                $existingImagesToDelete = $post->images()->whereNotIn('id', $existingImages)->get();
                foreach($existingImagesToDelete as $existingImage)
                {
                    Storage::disk('public')->delete($existingImage->path_name);
                    $existingImage->delete();
                }
            }

            if($request->hasFile('images'))
            {
                foreach($request->file('images') as $image)
                {
                    $path = $image->store('posts', 'public');
                    $post->images()->create([
                        'path_name' => $path
                    ]);
                }
            }

        });

        return redirect()->back()->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        foreach($post->images as $image)
        {
            Storage::disk('public')->delete($image->path_name);
        }

        $post->delete();
        return redirect()->back()->with('success', 'Post deleted');
    }
}
