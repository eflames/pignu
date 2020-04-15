<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spotlights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',150);
            $table->string('description');
            $table->string('link');
            $table->string('file')->unique();
            $table->integer('position');
            $table->string('active',2)->nullable();
            $table->bigInteger('created_by')->unsigned();
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
        Schema::drop('spotlights');
    }
}
