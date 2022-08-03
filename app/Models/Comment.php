<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Comment belongs to 1 Post
     * เพิ่ม post() คืนค่าความมสัมพันธ์ belongs to
     * เพิ่ม attribute post คืนค่า object ของ Post ที่ผูกกับ Comment นั้น
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
