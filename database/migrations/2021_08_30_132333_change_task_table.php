<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->longText('comment')->nullable()->comment('комментарий при окончании');
            $table->integer('implementer_end_id')->unsigned()->nullable()->comment('id исполнителя при окончании');
            $table->foreign('implementer_end_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign('task_implementer_end_id_foreign');
            $table->dropColumn('implementer_end_id');
            $table->dropColumn('comment');
        });
    }
}
