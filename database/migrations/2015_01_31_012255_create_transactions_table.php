<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('bill_id')->unsigned();
            $table->string('payee', 128);
            $table->float('amount');
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
