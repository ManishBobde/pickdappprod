<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postTitle');
            $table->string('shortDescription');
            $table->string('sourceName');
            $table->string('sourceUrl');
            $table->string('imageUrl');
            $table->string('categoryId');
            $table->string('curatorId');
            $table->string('createdDate');
            $table->string('publishedDate');
            $table->boolean('isVideoPost')->default(false)	;
            $table->boolean('needsPushNotification')->default(false);
            $table->boolean('isNotificationSent')->default(false);
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
        Schema::drop('posts');
    }
}
