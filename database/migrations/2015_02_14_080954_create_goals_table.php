<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('goals');
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 128);
            $table->date('start_date');
            $table->date('goal_date');
            $table->float('balance');
            $table->float('amount');
            $table->softDeletes();
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
        Schema::drop('goals');
    }
}
