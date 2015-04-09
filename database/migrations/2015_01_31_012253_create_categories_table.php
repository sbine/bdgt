<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('categories');
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('label', 128);
            $table->integer('parent_category_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('parent_category_id')
                    ->references('id')->on('categories')
                    ->onDelete('set null');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
