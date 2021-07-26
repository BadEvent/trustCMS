<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id')->comment('id задачи');
            $table->integer('date_add')->comment('дата создания')->nullable();
            $table->integer('date_start')->comment('дата начала')->nullable();
            $table->integer('date_end')->comment('дата завершения')->nullable();
            $table->integer('deadline')->comment('крайний срок')->nullable();
            $table->integer('holder_id')->unsigned()->comment('id создателя задачи');
            $table->integer('implementer_id')->unsigned()->comment('id исполнителя');
            $table->integer('organization_id')->unsigned()->comment('id организации');
            $table->string('title', 255)->comment('заголовок задачи');
            $table->longText('data')->comment('вся информация по задаче');
            $table->integer('priority')->comment('приоритет (1-9, 1 - наивысший, 9 - наименьший)');
        });

        Schema::table('task', function ($table) {
            $table->foreign('holder_id')->references('id')->on('users');
            $table->foreign('implementer_id')->references('id')->on('users');
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
        // удаление внешнего ключа из таблицы users
        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign('task_holder_id_foreign');
            $table->dropForeign('task_implementer_id_foreign');
            $table->dropForeign('task_organization_id_foreign');
        });

        Schema::dropIfExists('task');
    }
}
