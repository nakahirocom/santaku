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
            // datetimeカラムをミリ秒単位で保存するように変更
            $table->datetime('start_solving_time', 3)->nullable()->change();
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
            // カラムを元に戻す
            $table->timestamp('start_solving_time')->nullable()->change();
        });
    }
};
