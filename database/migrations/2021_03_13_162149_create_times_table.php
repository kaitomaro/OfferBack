<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->boolean('monday')->nullable()->default(true);
            $table->boolean('tsuesday')->nullable()->default(true);
            $table->boolean('wednesday')->nullable()->default(true);
            $table->boolean('thursday')->nullable()->default(true);
            $table->boolean('friday')->nullable()->default(true);
            $table->boolean('saturday')->nullable()->default(true);
            $table->boolean('sunday')->nullable()->default(true);
            $table->integer('time_type');
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
        Schema::dropIfExists('times');
    }
}
