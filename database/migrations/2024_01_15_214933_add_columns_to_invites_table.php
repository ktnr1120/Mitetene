<?php

// database/migrations/YYYY_MM_DD_XXXXXX_add_columns_to_invites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToInvitesTable extends Migration
{
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->string('name')->after('email')->nullable();
            $table->string('password')->after('name');
        });
    }

    public function down()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->dropColumn(['name', 'password']);
        });
    }
}
