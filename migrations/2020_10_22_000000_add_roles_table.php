<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tager_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('scopes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tager_administrator_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrator_id');
            $table->unsignedBigInteger('role_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('administrator_id')->references('id')->on('tager_administrators');
            $table->foreign('role_id')->references('id')->on('tager_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tager_administrator_roles');
        Schema::dropIfExists('tager_roles');
    }
}
