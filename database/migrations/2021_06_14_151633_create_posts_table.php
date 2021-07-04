<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->longText('description');
            $table->string('imagePath');
            $table->boolean('published');
            $table->timestamps();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('categoryId');
            $table->foreign('categoryId')->references('id')->on('categories');
            $table->foreign('userId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
