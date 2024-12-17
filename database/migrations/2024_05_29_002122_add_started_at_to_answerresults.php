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
        Schema::table('answer_results', function (Blueprint $table) {
            // timestampとは別に時間を記録するカラムを追加
            $table->timestamp('start_solving_time')->nullable()->after('answered_question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_results', function (Blueprint $table) {
            // upメソッドで追加したstart_solving_timeカラムを削除
            $table->dropColumn('start_solving_time');
        });
    }
};
