<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $post = Post::where('id','1')->first();
        $comment = new Comment();
        $comment->user_id = '4';
        $comment->message = 'เห็นด้วย สะดุดหินหลายรอบแล้ว เจ็บ';
        $date = $this->getDate('1');
        $comment->created_at = $date;
        $comment->updated_at = $date;
        $post->comments()->save($comment);

        $comment = new Comment();
        $comment->user_id = '7';
        $comment->message = 'ไม่รู้ว่าเมื่อไรจะแก้ปัญหาสักที ทุกวันนี้ยังเห็นอยู่เลย แล้วพอหน้าฝนก็เดินลำบากมาก';
        $date = $this->getDate('1');
        $comment->created_at = $date;
        $comment->updated_at = $date;
        $post->comments()->save($comment);

        $post = Post::where('id','2')->first();
        $comment = new Comment();
        $comment->user_id = '8';
        $comment->message = 'ไม่รู้ว่าทำไมไม่มีใครคอมเม้นเลย แต่ประสบการณ์ส่วนตัวบอกไว้ว่าให้ดูรีวิวก่อนลงทะเบียน';
        $date = $this->getDate('2');
        $comment->created_at = $date;
        $comment->updated_at = $date;
        $post->comments()->save($comment);

        $post = Post::where('id','3')->first();
        $comment = new Comment();
        $comment->user_id = '1'; // admin
        $comment->message = 'หมายถึงห้องน้ำไหนหรอครับ ช่วยใส่ข้อมูลให้ครบด้วยนะครับ';
        $date = $this->getDate('3');
        $comment->created_at = $date;
        $comment->updated_at = $date;
        $post->comments()->save($comment);
        // admin/staff changes info
        $post->status = 'info';
        $post->resolved_by = User::where('id','1')->first()->name;
//        $post->resolved_date = $date;
        $post->updated_at = $date;
        $post->save();

        $post = Post::where('id','4')->first();
        $comment = new Comment();
        $comment->user_id = '2'; // staff
        $comment->message = 'เรื่องเน็ตของ dtac ผมไม่รู้นะว่าจะสามารถแก้ไขได้มั้ย เพราะต้องมาตั้งเสาสัญญาณใกล้ๆ แต่ผมส่งเรื่องส่วนที่เกี่ยวกับ KUWIN ให้แล้วนะครับ';
        $date = $this->getDate('4');
        $comment->created_at = $date;
        $comment->updated_at = $date;
        $post->comments()->save($comment);
        $post->status = 'fix';
        $post->resolved_by = User::where('id','2')->first()->name;
        $post->updated_at = $date;
        $post->save();

    }

    private function getDate($post_id) {
        $date = fake()->dateTimeBetween('-5 years')->format('Y-m-d H:i:s');
        while ( !(Post::where('id',$post_id)->whereDate('created_at','<=',$date)->first()) ) {
            $date = fake()->dateTimeBetween('-5 years')->format('Y-m-d H:i:s');
        }
        return $date;
    }
}
