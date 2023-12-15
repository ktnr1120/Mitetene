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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('id')->on('users'); // users テーブルの id カラムを参照
            $table->unsignedBigInteger('Children_ID');
            $table->date('Date');
            $table->string('title', 50);
            $table->string('body', 200);
            $table->timestamps(); //create_at, updated_at カラムを作成
            $table->tinyInteger('IsDelete')->default(0);
            $table->softDeletes(); //delete_at カラムを作成
        });
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
