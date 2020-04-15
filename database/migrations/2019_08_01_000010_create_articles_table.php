<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->bigInteger('created_by')->unsigned();
            $table->string('title',150);
            $table->string('slug');
            $table->string('image');
            $table->string('tags');
            $table->text('resume',1000);
            $table->text('body');
            $table->dateTime('publish_date');
            $table->tinyInteger('visible');
            $table->integer('views')->nullable();
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
        Schema::drop('articles');
    }
}
