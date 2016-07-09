<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->dateTime('date');
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('bill_id')->unsigned()->nullable();
            $table->string('payee', 128);
            $table->float('amount', 12, 3);
            $table->tinyInteger('inflow');
            $table->tinyInteger('cleared');
            $table->string('flair', 32)->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
