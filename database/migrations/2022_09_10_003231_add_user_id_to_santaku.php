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
        Schema::table('santaku', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');

            // usersテーブルのidカラムにuser_idカラムを関連づけます。
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santaku', function (Blueprint $table) {
            $table->dropForeign('santaku_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
