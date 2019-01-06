<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('payeer');
            $table->enum('type', ['input', 'output']);
            $table->enum('type_state', ['success', 'error']);
            $table->float('pay', 8, 2);
            $table->text('message')->nullable();
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
        Schema::dropIfExists('pays_log');
    }
}
