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
//            // 既存のカラム 'selected' の名前を 'small_label_id_selected' に変更
//            $table->renameColumn('selected', 'small_label_id_selected');
//            // 既存のカラム 'basic_select' の名前を 'small_label_id_basic_selected' に変更
//            $table->renameColumn('basic_select', 'small_label_id_basic_selected');

            // カラム 'small_label_id_basic_selected' の後に 'commontag_id' を追加
            $table->unsignedBigInteger('commontag_id')->nullable()->after('basic_select');
            // 'commontag_id' に対して 'common_tags' テーブルの 'id' を参照する外部キーを追加
            $table->foreign('commontag_id')->references('id')->on('common_tags');
            // 'commontag_selected' カラムを 'commontag_id' の後に追加（boolean型）
            $table->boolean('commontag_selected')->nullable()->after('commontag_id');
            // 'commontag_basic_selected' カラムを 'commontag_selected' の後に追加（boolean型）
            $table->boolean('commontag_basic_selected')->nullable()->after('commontag_selected');

            // カラム 'commontag_basic_selected' の後に 'individualtag_id' を追加
            $table->unsignedBigInteger('individualtag_id')->nullable()->after('commontag_basic_selected');
            // 'individualtag_id' に対して 'individual_tags' テーブルの 'id' を参照する外部キーを追加
            $table->foreign('individualtag_id')->references('id')->on('individual_tags');
            // 'individualtag_selected' カラムを 'individualtag_id' の後に追加（boolean型）
            $table->boolean('individualtag_selected')->nullable()->after('individualtag_id');
            // 'individualtag_basic_selected' カラムを 'individualtag_selected' の後に追加（boolean型）
            $table->boolean('individualtag_basic_selected')->nullable()->after('individualtag_selected');
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
//            // 既存のカラム 'selected' の名前を 'small_label_id_selected' から戻す
//            $table->renameColumn('small_label_id_selected','selected');
//            // 既存のカラム 'basic_select' の名前を 'small_label_id_basic_selected' から戻す
//            $table->renameColumn('small_label_id_basic_selected','basic_select');


            // 外部キー 'commontag_id' に関連する制約を削除
            $table->dropForeign(['commontag_id']);
            // 外部キー 'individualtag_id' に関連する制約を削除
            $table->dropForeign(['individualtag_id']);

            // 'commontag_id' カラムを削除
            $table->dropColumn('commontag_id');
            // 'commontag_selected' カラムを削除
            $table->dropColumn('commontag_selected');
            // 'commontag_basic_selected' カラムを削除
            $table->dropColumn('commontag_basic_selected');
            // 'individualtag_id' カラムを削除
            $table->dropColumn('individualtag_id');
            // 'individualtag_selected' カラムを削除
            $table->dropColumn('individualtag_selected');
            // 'individualtag_basic_selected' カラムを削除
            $table->dropColumn('individualtag_basic_selected');
        });
    }
};
