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
        Schema::create('individualtag_question', function (Blueprint $table) {
            // individualtag_questionテーブルにidを追加
            $table->id();
            // individualtag_questionテーブルにindividualtag_idを追加
            $table->unsignedBigInteger('individualtag_id');
            // individualtag_questionテーブルのindividualtag_idカラムにindividual_tagsテーブルのidカラムを関連づける
            $table->foreign('individualtag_id')->references('id')->on('individual_tags');

            // individualtag_questionテーブルにquestion_idを追加
            $table->unsignedBigInteger('question_id');
            // individualtag_questionテーブルのquestion_idカラムにquestionsテーブルのidカラムを関連づける
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
        Schema::dropIfExists('individualtag_question');
    }
};
