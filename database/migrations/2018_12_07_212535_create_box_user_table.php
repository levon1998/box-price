<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('box_id');
            $table->integer('user_id');
            $table->enum('state', ['closed', 'open'])->default('closed');
            $table->timestamp('opened_date')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('box_user');
    }
}
