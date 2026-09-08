<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Post::factory(50)->create();
         Comment::factory(50)->create();
         Tag::factory(50)->create();

        $posts = Post::all();
        $users = User::all();
        $tags = Tag::all();

        // Post likes
        foreach ($posts as $post) {
            $randomUsers = $users->random(rand(1, $users->count()));

            foreach ($randomUsers as $user) {
                DB::table('post_likes')->insert([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // Post tags
        foreach ($posts as $post) {
            $randomTags = $tags->random(rand(1, min(5, $tags->count())));

            foreach ($randomTags as $tag) {
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }
    }
}
