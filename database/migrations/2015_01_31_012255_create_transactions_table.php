<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->dateTime('date');
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('bill_id')->unsigned()->nullable();
            $table->string('payee', 128);
            $table->decimal('amount', 12, 3);
            $table->tinyInteger('inflow');
            $table->tinyInteger('cleared');
            $table->string('flair', 32)->nullable();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')
                    ->references('id')->on('accounts')
                    ->onDelete('cascade');

            $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('set null');

            $table->foreign('bill_id')
                    ->references('id')->on('bills')
                    ->onDelete('set null');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
