<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Post::class); // foreign key ชื่อ post_id
            $table->text('message');
            $table->timestamps();
            $table->softDeletes(); // เพิ่ม column ชื่อ deleted_at (timestamp) ไม่ได้ลบจริง แต่ถ้ามีคือไม่ต้อง query
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
