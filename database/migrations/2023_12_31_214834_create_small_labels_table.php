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
        Schema::create('small_labels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('middle_label_id');
            $table->string('small_label');
            $table->timestamps();

            $table->foreign('middle_label_id')->references('id')->on('middle_labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('small_labels');
    }
};
