<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment('Заголовок страницы');
            $table->text('link')->comment('Ссылка страницы');
            $table->longText('content')->nullable()->comment('Наполнение страницы');
            $table->integer('status')->default('0')->comment('1 - видна всем, 0 - только для админа');
            $table->integer('author')->nullable()->comment('id автора');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
