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
        Schema::create('answer_results', function (Blueprint $table) {
            $table->id();
            // answer_resultsテーブルにuser_idを追加
            $table->unsignedBigInteger('user_id');
            // answer_resultsテーブルのuser_idカラムにusersテーブルのuser_idカラムを関連づける
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // answer_resultsテーブルにquestion_idカラムを追加
            $table->unsignedBigInteger('question_id');
            // answer_resultsテーブルのquestion_idカラムにquestionsテーブルのquestion_idカラムを関連づける
            $table->foreign('question_id')->references('id')->on('santaku')->onDelete('cascade');
            // 選択した答えのquestion_idを保存するカラムを追加
            $table->integer('answered_question_id');
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
        Schema::drop('answer_results');
    }
};
