<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('kind_of_prize')->default(0);
            $table->integer('amount_of_money')->default(0);
            $table->integer('notice_id')->default(0);
            $table->integer('sent')->default(0);
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
        Schema::dropIfExists('lotos');
    }
}
