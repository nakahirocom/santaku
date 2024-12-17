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
        Schema::create('large_labels', function (Blueprint $table) {
            // large_labelsテーブルにidを追加
            $table->id();
            // large_labelsテーブルにlarge_label(大分類名)を追加
            $table->string('large_label')->nullable();
            // タイムスタンプのカラムを追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('large_labels');
    }
};
