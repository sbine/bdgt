<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('goals');
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('label', 128);
            $table->date('start_date');
            $table->date('goal_date');
            $table->float('balance');
            $table->float('amount');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::drop('goals');
    }
}
