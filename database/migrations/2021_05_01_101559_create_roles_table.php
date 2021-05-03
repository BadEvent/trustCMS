<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('id роли');
            $table->string('role_name', 255)->comment('имя роли (1 - Супер админ, 2 - Админ, 3 - Меренджер, 4 - Пользователь)');
        });

//        создание внешнего ключа из таблицы users
        Schema::table('users', function ($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        удаление внешнего ключа из таблицы users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
        });

        Schema::dropIfExists('roles');
    }
}
