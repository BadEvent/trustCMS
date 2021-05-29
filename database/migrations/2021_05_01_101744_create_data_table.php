<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id')->comment('id data');
            $table->string('first_name', 255)->comment('имя пользователя');
            $table->string('second_name', 255)->comment('фамилия пользователя');
            $table->string('phone', 255)->comment('телефон пользователя');
            $table->integer('organization_id')->unsigned()->comment('id организации');
        });
        // создание внешнего ключа из таблицы users
        Schema::table('users', function($table) {
            $table->foreign('data_id')->references('id')->on('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // удаление внешнего ключа из таблицы users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_data_id_foreign');
        });

        Schema::dropIfExists('data');
    }
}
