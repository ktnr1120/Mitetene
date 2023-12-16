<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyWeatherTable extends Migration
{
    public function up()
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->string('code')->default('sunny')->after('id'); // 天気を識別するコード
        });
    }

    public function down()
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
}