<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAndroidDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('androiddevices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deviceId');
            $table->string('deviceType');
            $table->string('pushRegId')->nullable();
            $table->string('deviceModelName')->nullable();
            $table->string('osType');
            $table->string('osVersion')->nullable();
            $table->string('appVersion')->nullable();
            $table->string('notificationEnabled')->default(true);
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
        Schema::drop('androiddevices');
    }
}
