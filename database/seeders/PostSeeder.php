<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Post::factory(10)->create();

        $post = Post::where('title','ทางเดินในมหาวิทยาลัยเสี่ยงอุบัติเหตุมาก')->first();
        if (!$post) {
            $post = new Post();
            $post->user_id = User::where('id','6')->first()->id;
            $post->title = "ทางเดินในมหาวิทยาลัยเสี่ยงอุบัติเหตุมาก";
            $post->description = "ทางเดินในมหาลัย มีต้นไม้ มีเสาไฟ พอฝนตก มีน้ำท่วมอีก ทำไมเดินลำบากจัง";
//            $post->tags()->sync($this->syncTags("ทางเดิน, อุบัติเหตุ, สกปรก"));
            $post->view_count = 1500;
            $post->like_count = 30;

            $date = fake()->dateTimeBetween('-5 years')->format('Y-m-d H:i:s');
            $post->created_at = $date;
            $post->updated_at = $date;
            $post->pictures = 'post1.png';
            $post->issue_date = $date;

            $post->save();
        }

        $post = Post::where('title','มาบ่นให้ฟังว่าวิชานี้แย่')->first();
        if (!$post) {
            $post = new Post();
            $post->user_id = User::where('id','4')->first()->id;
            $post->title = "มาบ่นให้ฟังว่าวิชานี้แย่";
            $post->description = "เรียนอะไรไปไม่รู้ จำได้แค่สอบไม่ตรงกับที่เรียนไปเลย";
//            $post->tags()->sync($this->syncTags("หลักสูตร, อาจารย์, สอบ, สอน"));
            $post->view_count = 12912;
            $post->like_count = 1044;

            $date = fake()->dateTimeBetween('-2 years')->format('Y-m-d H:i:s');
            $post->created_at = $date;
            $post->updated_at = $date;
            $post->issue_date = $date;

            $post->save();
        }

        $post = Post::where('title','ห้องน้ำแย่มาก')->first();
        if (!$post) {
            $post = new Post();
            $post->user_id = User::where('id','5')->first()->id;
            $post->title = "ห้องน้ำแย่มาก";
            $post->description = "รู้งี้ไปเข้ากลางถนนดีกว่า";
//            $post->tags()->sync($this->syncTags("ห้องน้ำ, สกปรก"));
            $post->view_count = 142;
            $post->like_count = 2;

            $date = fake()->dateTimeBetween('-2 years')->format('Y-m-d H:i:s');
            $post->created_at = $date;
            $post->updated_at = $date;
            $post->issue_date = $date;

            $post->save();
        }

        $post = Post::where('title','เน็ต KUWIN ในห้องสมุดภาควิชาวิทยาการคอมพิวเตอร์ช้ามาก')->first();
        if (!$post) {
            $post = new Post();
            $post->user_id = User::where('id','4')->first()->id;
            $post->title = "เน็ต KUWIN ในห้องสมุดภาควิชาวิทยาการคอมพิวเตอร์ช้ามาก";
            $post->description = "เน็ต dtac ก็ช้า wifi ของมหาลัยก็ช้า ช่วยแก้ปัญหาด้วย";
//            $post->tags()->sync($this->syncTags("WIFI, internet, ห้องสมุด"));
            $post->view_count = 12;
            $post->like_count = 1;

            $date = fake()->dateTimeBetween('-2 years')->format('Y-m-d H:i:s');
            $post->created_at = $date;
            $post->updated_at = $date;
            $post->issue_date = $date;

            $post->save();
        }
    }

}
