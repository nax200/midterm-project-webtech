<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Comment::factory(700)->create();
        $posts = Post::all();
        foreach ($posts as $post) {
            $comment_amount = random_int(0,10);
            for ($i = 1; $i <= $comment_amount; $i++) {
                $comment = new Comment();
                $comment->message = fake()->realText(100);
                $date = fake()->dateTimeBetween('-10 years')->format('Y-m-d H:i:s');
                $comment->created_at = $date;
                $comment->updated_at = $date;
                $post->comments()->save($comment);
            }
        }


    }

}
