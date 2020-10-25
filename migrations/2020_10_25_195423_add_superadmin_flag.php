<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSuperAdminFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tager_roles', function (Blueprint $table) {
            $table->boolean('is_super_admin')->default(false);
        });

        DB::update('UPDATE tager_roles SET is_super_admin=1 where name ="Super Administrator"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tager_roles', function (Blueprint $table) {
            $table->dropColumn('is_super_admin');
        });
    }
}
