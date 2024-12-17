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
        Schema::table('label_storages', function (Blueprint $table) {
            // label_storagesテーブルのsmall_label_idカラムにsmall_labelテーブルのidカラムを関連づける
            $table->foreign('small_label_id')->references('id')->on('small_labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('label_storages', function (Blueprint $table) {
            //
        });
    }
};
