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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            // 何回目
            $table->unsignedBigInteger('time');

            $table->unsignedBigInteger('small_label_id');
            // questionsテーブルのsmall_label_idカラムにsmall_labelsテーブルのidカラムを関連づける
            $table->foreign('small_label_id')->references('id')->on('small_labels')->onDelete('cascade');
            $table->string('small_label');

            $table->unsignedBigInteger('rank');

            $table->unsignedBigInteger('user_id');
            // usersテーブルのidカラムにuser_idカラムを関連づけます。
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');

            // small_lavel単位の正解率。データ型decimal('accuracy', 6, 3)で999.999〜マイナス999.999まで表示可能
            $table->decimal('accuracy', 6, 3);
            // small_lavel単位の正解数。整数しかあり得ないためunsignedBigInteger型0~18446744073709551615。
            $table->unsignedBigInteger('correct');
            // small_lavel単位の不正解数。整数しかあり得ないためunsignedBigInteger型0~18446744073709551615。
            $table->unsignedBigInteger('incorrect');
            // small_lavel単位の出題数。整数しかあり得ないためunsignedBigInteger型0~18446744073709551615。
            $table->unsignedBigInteger('total');
            // small_lavel単位の平均回答時間。データ型decimal('accuracy', 6, 3)で999.999〜マイナス999.999まで表示可能
            $table->decimal('average_time', 6, 3);

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
        Schema::dropIfExists('ranks');
    }
};
