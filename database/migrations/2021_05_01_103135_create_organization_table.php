<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->increments('id')->comment('id пользователя');
            $table->string('name', 255)->comment('имя организации');
            $table->string('address', 255)->comment('адрес организации');
            $table->string('housing', 255)->comment('корпус организации');
            $table->string('office', 255)->comment('кабинет организации');
        });

        //        создание внешнего ключа из таблицы data
        Schema::table('data', function($table) {
            $table->foreign('organization_id')->references('id')->on('organization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //        удаление внешнего ключа из таблицы data
        Schema::table('data', function (Blueprint $table) {
            $table->dropForeign('data_organization_id_foreign');
        });

        Schema::dropIfExists('organization');
    }
}
