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
        Schema::table('kaizens', function (Blueprint $table) {
            $table->unsignedBigInteger('status')->nullable()->after('kaizen');
            $table->string('developer_comment')->nullable()->after('kaizen');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kaizens', function (Blueprint $table) {
            $table->dropForeign('status');
            $table->dropColumn('status');

        });
    }
};
