<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->integer('year');
            $table->integer('month');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->decimal('budgeted', 12, 3);
            $table->decimal('spent', 12, 3);
            $table->decimal('balance', 12, 3);
            $table->timestamps();

            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('set null');
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('budgets');
    }
};
