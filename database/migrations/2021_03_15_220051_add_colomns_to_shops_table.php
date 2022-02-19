<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomnsToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->text('sentence')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('top_image')->nullable();
            $table->string('sns')->nullable();
            $table->string('hp')->nullable();
            $table->string('payment_options')->nullable();
            $table->string("number_of_seats")->nullable();
            $table->boolean('closed')->default(false);
            $table->boolean('is_vip')->default(false);
            $table->integer('category_1')->nullable();
            $table->integer('category_2')->nullable();
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
            $table->dropColumn('phone');
            $table->dropColumn('sentence');
            $table->dropColumn('address');
            $table->dropColumn('zip_code');
            $table->dropColumn('top_image');
            $table->dropColumn('sns');
            $table->dropColumn('hp');
            $table->dropColumn('payment_options');
            $table->dropColumn('number_of_seats');
            $table->dropColumn('closed');
            $table->dropColumn('is_vip');
            $table->dropColumn('category_1');
            $table->dropColumn('category_2');
        });
    }
}
