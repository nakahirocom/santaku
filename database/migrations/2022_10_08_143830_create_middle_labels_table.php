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
        Schema::create('middle_labels', function (Blueprint $table) {
            // middle_labelsテーブルにidを追加
            $table->id();
            // middle_labelsテーブルにlarge_label_idを追加
            $table->unsignedBigInteger('large_label_id')->nullable();
            // middle_labelsテーブルのlarge_label_idカラムにlarge_labelsテーブルのidカラムを関連づける
            $table->foreign('large_label_id')->references('id')->on('large_labels')->onDelete('cascade');
            // large_labelsテーブルにmiddle_label(中分類名)を追加
            $table->string('middle_label')->nullable();
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
        Schema::dropIfExists('middle_labels');
    }
};
