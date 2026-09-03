<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PostService
{
    /**
     * @param array $data
     * @param User $user
     * @return void
     * @throws Throwable
     */
    public function store(array $data, User $user)
    {
        DB::transaction(function () use ($data, $user) {
            $post = Post::create([
                'content' => $data['content'],
                'user_id' => $user->id
            ]);
            $this->uploadImages(
                $data['images'] ?? [],
                $post
            );
            $this->attachTags(
                $data['tags'] ?? [],
                $post
            );
        });
    }

    /**
     * @param array $data
     * @param Post $post
     * @return void
     * @throws Throwable
     */
    public function update(array $data, Post $post): void
    {
        DB::transaction(function () use ($post, $data) {
            $post->update($data);

            $post->tags()->sync(
                collect($data['tags'])->pluck('id')
            );

            $this->handleExistingImages(
                $data['existingImages'] ?? [],
                $post
            );

            $this->uploadImages(
                $data['images'] ?? [],
                $post
            );
        });
    }

    /**
     * @param Post $post
     * @return void
     */
    public function delete(Post $post): void
    {
        foreach($post->images as $image)
        {
            Storage::disk('public')->delete($image->path_name);
        }

        $post->delete();
    }

    /**
     * @param array $data
     * @param Post $post
     * @return void
     */
    private function uploadImages(array $data, Post $post): void
    {
        foreach($data as $image)
        {
            $path = $image->store('posts', 'public');
            $post->images()->create([
                'path_name' => $path
            ]);
        }
    }

    /**
     * @param array $data
     * @param Post $post
     * @return void
     */
    private function attachTags(array $data, Post $post): void
    {
        $post->tags()->attach(
            collect($data['tags'])->pluck('id')
        );
    }

    /**
     * @param array $data
     * @param Post $post
     * @return void
     */
    private function handleExistingImages(array $data, Post $post): void
    {
        $existingImages = collect($data)->pluck('id');
        $existingImagesToDelete = $post->images()->whereNotIn('id', $existingImages)->get();
        foreach($existingImagesToDelete as $existingImage)
        {
            Storage::disk('public')->delete($existingImage->path_name);
            $existingImage->delete();
        }
    }
}
