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
        Schema::create('commontag_question', function (Blueprint $table) {
            // commontag_questionテーブルにidを追加
            $table->id();
            // commontag_questionテーブルにcommontag_idを追加
            $table->unsignedBigInteger('commontag_id');
            // commontag_questionテーブルのcommontag_idカラムにcommon_tagsテーブルのidカラムを関連づける
            $table->foreign('commontag_id')->references('id')->on('common_tags');

            // commontag_questionテーブルにquestion_idを追加
            $table->unsignedBigInteger('question_id');
            // commontag_questionテーブルのquestion_idカラムにquestionsテーブルのidカラムを関連づける
            $table->foreign('question_id')->references('id')->on('questions');

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
        Schema::dropIfExists('commontag_question');
    }
};
