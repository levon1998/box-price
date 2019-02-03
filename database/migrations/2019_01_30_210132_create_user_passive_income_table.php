<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPassiveIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_passive_income', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('passive_income_id');
            $table->date('buy_date');
            $table->date('end_date');
            $table->tinyInteger('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_passive_income');
    }
}
