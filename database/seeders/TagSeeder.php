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
        $post = Post::where('id', '1')->first();
        $post->tags()->sync($this->syncTags("ทางเดิน, อุบัติเหตุ, สกปรก"));

        $post = Post::where('id', '2')->first();
        $post->tags()->sync($this->syncTags("หลักสูตร, อาจารย์, สอบ, สอน"));

        $post = Post::where('id', '3')->first();
        $post->tags()->sync($this->syncTags("ห้องน้ำ, สกปรก"));

        $post = Post::where('id', '4')->first();
        $post->tags()->sync($this->syncTags("WIFI, internet, ห้องสมุด"));
    }

    private function syncTags($tags) {
        // explode() -> แยกสตริงเป็นก้อนๆ
        $tags = explode(',', $tags);
        // แปลง string เพราะมี ' ' ขั้นหน้า เลยต้องตัดออก
        $tags = array_map(function ($v) {
            // associative function (unnamed function / closure)

            // uppercase first
            return Str::ucfirst(trim($v));
        }, $tags);

        $tag_ids = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            }
            $tag_ids[] = $tag->id;
        }

        return $tag_ids;
    }


}
