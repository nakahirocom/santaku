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
        Schema::table('questions', function (Blueprint $table) {
            // 既存のquestion_pathとcomment_pathカラムをnullableに変更
            $table->string('question_path')->nullable()->change();
            $table->string('comment_path')->nullable()->change();
        });
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // 変更を元に戻す（nullableを削除）
            // 元のカラムの状態（例えばnullableでなかった場合）に注意してください
            $table->string('question_path')->change();
            $table->string('comment_path')->change();
        });
  
    }
};
