<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageIdToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // image_id カラムの追加
            $table->unsignedBigInteger('image_id')->nullable();

            // 外部キー制約の設定
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // マイグレーションのロールバック時に実行される処理
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
    }
}