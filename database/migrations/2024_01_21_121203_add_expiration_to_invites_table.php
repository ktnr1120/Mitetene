<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpirationToInvitesTable extends Migration
{
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->timestamp('expiration')->nullable();
        });
    }

    public function down()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->dropColumn('expiration');
        });
    }
}
