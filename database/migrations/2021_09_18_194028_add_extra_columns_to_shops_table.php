<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->integer('lunch_estimated_bottom_price')->nullable();
            $table->integer('lunch_estimated_high_price')->nullable();
            $table->integer('dinner_estimated_bottom_price')->nullable();
            $table->integer('dinner_estimated_high_price')->nullable();
            $table->string('holiday')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('lunch_estimated_bottom_price');
            $table->dropColumn('lunch_estimated_high_price');
            $table->dropColumn('dinner_estimated_bottom_price');
            $table->dropColumn('dinner_estimated_high_price');
            $table->dropColumn('holiday');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
        });
    }
}
