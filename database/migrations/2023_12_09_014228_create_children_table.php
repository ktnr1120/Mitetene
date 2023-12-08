<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id('children_ID');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('id')->on('users')->onDelete('cascade');
            $table->string('child_Name');
            $table->timestamps(); // created_at, updated_at カラムを作成
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
}
