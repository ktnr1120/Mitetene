<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostIdToImagesTable extends Migration
{
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            // post_id カラムを追加
            $table->unsignedBigInteger('post_id')->nullable();

            // 外部キー制約を追加
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        // ロールバック時に必要ならここに対応する処理を追加
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['post_id']);  // 外部キー制約の削除
            $table->dropColumn('post_id');    // カラムの削除
        });
    }
}
