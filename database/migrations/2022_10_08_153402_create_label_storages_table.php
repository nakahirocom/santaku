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
        Schema::create('label_storages', function (Blueprint $table) {
            // label_storagesテーブルにidを追加
            $table->id();
            // label_storagesテーブルにuser_idを追加
            $table->unsignedBigInteger('user_id');
            // label_storagesテーブルのuser_idカラムにusersテーブルのidカラムを関連づける
            $table->foreign('user_id')->references('id')->on('users');

            // label_storagesテーブルにsmall_label_idを追加
            $table->unsignedBigInteger('small_label_id');

            // label_storagesテーブルにselectを追加
            $table->boolean('select');

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
        Schema::dropIfExists('label_storages');
    }
};
