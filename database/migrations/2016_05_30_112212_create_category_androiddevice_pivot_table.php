<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAndroiddevicePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('android_device_categories', function(Blueprint $table) {
            $table->integer('categories_id')->unsigned()->index();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('android_device_id')->unsigned()->index();
            $table->foreign('android_device_id')->references('id')->on('androiddevices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('android_device_categories');
    }
}
