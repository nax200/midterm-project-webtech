<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = Post::all();
        foreach ($posts as $post) {
            $tags = fake()->randomElements( ['Gaming','Coding','Food','Sports','Education','Technology','Cartoon'],
                $count=random_int(1,7) );
            $tag_ids = [];

            foreach ($tags as $tag_name) {
                $tag = Tag::where('name', $tag_name)->first(); // search for tag
                if (!$tag) { // create a new tag if the tag never existed
                    $tag = new Tag();
                    $tag->name = $tag_name;
                    $tag->save();
                } // if not, do nothing, because we already got the tag when we searched
                $tag_ids[] = $tag->id; // add tag id to the tag list
            }

            $post->tags()->sync($tag_ids); // add the whole tag list to the post
        }


    }
}
