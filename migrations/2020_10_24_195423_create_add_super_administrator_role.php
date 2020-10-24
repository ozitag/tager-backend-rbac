<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateAddSuperAdministratorRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tager_roles')->insert([
            'name' => 'Super Administrator',
            'scopes' => '*',
        ]);
        DB::insert(
          "INSERT INTO tager_administrator_roles (administrator_id, role_id)
                 SELECT 1, id FROM tager_roles WHERE name = 'Super Administrator'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
