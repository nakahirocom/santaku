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
        Schema::table('kaizens', function (Blueprint $table) {
            // timestampとは別に時間を記録するカラムを追加
            $table->timestamp('developer_comment_update_time')->nullable()->after('developer_comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kaizens', function (Blueprint $table) {
            // upメソッドで追加したauthor_update_timeカラムを削除
            $table->dropColumn('developer_comment_update_time');
        });
    }
};
