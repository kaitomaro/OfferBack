<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->integer('service_id')->nullable();
            $table->integer('time_id');
            $table->integer('discount')->nullable();
            $table->boolean('display')->default(true);
            $table->integer('time_type');
            $table->integer('discount_type')->default(0);
            $table->boolean('telephone_reservation')->default(false);
            $table->boolean('first_time_discount')->default(false);
            $table->boolean('limited')->default(false);
            $table->integer('limited_amount')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
