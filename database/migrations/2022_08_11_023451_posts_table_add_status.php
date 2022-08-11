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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('status')->after('id')->default("Waiting reply");
            $table->string('pictures')->after('id')->nullable()->default(null);
            $table->string('resolved_by')->after('id')->nullable()->default(null);
            $table->date('resolved_date')->after('id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('pictures');
            $table->dropColumn('resolved_by');
            $table->dropColumn('resolved_when');
        });
    }
};
