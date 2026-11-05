<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAddSuperAdministratorRole extends Migration
{
    /**
     * Завести роль Super Administrator и выдать её первому администратору.
     *
     * Привязка делается только если администратор с id = 1 действительно
     * есть. Раньше строка в tager_administrator_roles вставлялась всегда,
     * потому что таблицу администраторов заводила миграция, сразу сеявшая
     * учётку с id = 1. С версии, где пакет перестал заводить администратора
     * с опубликованным паролем, на чистой установке администраторов нет
     * вовсе — и безусловная вставка роняла миграцию на внешнем ключе, то
     * есть новый проект не мигрировался вообще.
     *
     * На существующих установках администратор с id = 1 на месте, так что
     * поведение не меняется.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tager_roles')->insert([
            'name' => 'Super Administrator',
            'scopes' => '*',
        ]);

        $roleId = DB::table('tager_roles')
            ->where('name', 'Super Administrator')
            ->value('id');

        if (!$roleId) {
            return;
        }

        $administratorId = DB::table('tager_administrators')
            ->orderBy('id')
            ->value('id');

        if (!$administratorId) {
            return;
        }

        DB::table('tager_administrator_roles')->insert([
            'administrator_id' => $administratorId,
            'role_id' => $roleId,
        ]);
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
