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
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id('Post_ID');
                $table->foreignId('User_ID')->constrained('users'); //usersテーブルを参照
                $table->foreignId('children_ID')->constrained('children'); //childrenテーブルを参照
                $table->date('Date');
                $table->enum('Weather',['晴れ','曇り','雨','雪']);
                $table->enum('Category',['成長','発見','特技','行事','健康']);
                $table->string('title',50);
                $table->string('body',200);
                $table->timestamps();
                $table->softDeletes(); //ソフトデリート用のカラムを追加
                $table->boolean('IsDelete')->default(false);
                
                $table->index('Category'); //カテゴリをインデックス化
                $table->index('Weather'); //天気をインデックス化
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
