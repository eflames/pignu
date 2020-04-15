<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',150)->unique();
            $table->string('slug',255);
            $table->text('description');
            $table->tinyInteger('active')->nullable()->default(NULL);
            $table->tinyInteger('orderable')->nullable()->default(NULL);
            $table->tinyInteger('highlighted')->nullable()->default(NULL);
            $table->bigInteger('category_id')->unsigned();
            $table->string('cover_image',150);
            $table->string('folder',150);
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
