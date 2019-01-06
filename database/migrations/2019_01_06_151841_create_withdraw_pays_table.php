<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('payeer');
            $table->float('pay', 8, 2);
            $table->enum('state', ['in_process', 'success', 'error']);
            $table->tinyInteger('to_do')->default(0);
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
        Schema::dropIfExists('withdraw_pays');
    }
}
