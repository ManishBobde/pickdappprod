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
            $table->string('title');
            $table->string('body');
            $table->string('sourceTitle');
            $table->string('sourceUrl');
            $table->string('imageUrl')->nullable();
            $table->string('categoryId');
            $table->string('creatorId');
            $table->string('reviewerId');
            $table->string('createdDate')->nullable();
            $table->string('publishedDate')->nullable();
            $table->timestamp('submittedDate')->nullable();
            $table->boolean('isVideoPost')->default(false);
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
