<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('id пользователя');
            $table->string('login', 255)->comment('имя пользователя');
            $table->string('email', 255)->comment('email пользователя');
            $table->string('password', 255)->comment('пароль пользователя');
            $table->integer('role_id')->unsigned()->comment('1 - Супер админ, 2 - Админ, 3 - Меренджер, 4 - Пользователь');
            $table->integer('data_id')->unsigned()->comment('id всей информации пользователя');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
