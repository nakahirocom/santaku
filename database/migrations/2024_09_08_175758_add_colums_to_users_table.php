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
        Schema::table('users', function (Blueprint $table) {
            //basic_count
            $table->unsignedBigInteger('basic_count')->after('region_id');
            $table->unsignedBigInteger('base_continuous_correct_answers')->after('basic_count');
            $table->unsignedBigInteger('user_mode')->after('base_continuous_correct_answers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
