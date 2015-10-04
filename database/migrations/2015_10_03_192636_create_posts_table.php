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
        Schema::create('posts', function($t){
            $t->increments('id');
            $t->integer('user_id')->unsigned();
            $t->string('title', 255);
            $t->text('text');
            $t->dateTime('date_from');
            $t->boolean('enabled');
            $t->string('images', 255);
            $t->timestamps();
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
