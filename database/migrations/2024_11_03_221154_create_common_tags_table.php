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
        Schema::create('common_tags', function (Blueprint $table) {
            $table->id();
            // common_tagsテーブルにsmall_label_idを追加
            $table->unsignedBigInteger('small_label_id');
            // common_tagsテーブルのindividualtagカラムにsmall_labelsテーブルのidカラムを関連づける
            $table->foreign('small_label_id')->references('id')->on('small_labels')->onDelete('cascade');

            $table->string('commontag');
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
        Schema::dropIfExists('common_tags');
    }
};
