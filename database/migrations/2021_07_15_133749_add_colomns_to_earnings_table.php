<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnsToEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('earnings', function (Blueprint $table) {
            $table->string('name');
            $table->integer('service_id');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('discount_type');
            $table->integer('service_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('earnings', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('service_id');
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->dropColumn('discount_type');
            $table->dropColumn('service_type');
        });
    }
}
