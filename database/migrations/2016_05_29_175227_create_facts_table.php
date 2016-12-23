<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('sourceName');
            $table->string('sourceUrl');
            $table->string('categoryId');
            $table->string('curatorId');
            $table->string('createdDate');
            $table->string('publishedDate');
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
        Schema::drop('facts');

    }
}
