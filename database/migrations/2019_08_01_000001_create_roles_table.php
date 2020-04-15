<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',150);
            $table->tinyInteger('admin')->nullable()->default(NULL);
            $table->tinyInteger('p_products')->nullable()->default(NULL);
            $table->tinyInteger('p_blog')->nullable()->default(NULL);
            $table->tinyInteger('p_pages')->nullable()->default(NULL);
            $table->tinyInteger('p_galleries')->nullable()->default(NULL);
            $table->tinyInteger('p_categories')->nullable()->default(NULL);
            $table->tinyInteger('p_users')->nullable()->default(NULL);
            $table->tinyInteger('p_configs')->nullable()->default(NULL);
            $table->tinyInteger('p_log')->nullable()->default(NULL);
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
        Schema::drop('roles');
    }
}
