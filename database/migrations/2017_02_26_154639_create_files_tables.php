<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->text('filename');
            $table->text('original_name');
            $table->integer('ref_id')->unsigned();  
            $table->string('ref_type', 30);
            $table->mediumInteger('ordering')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('images_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('image_id')->references('id')->on('images');
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('tag', 30)->nullable();
            $table->string('lang', 5); //SLUG LINGUA       
            $table->timestamps();
        });


        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('filename');
            $table->text('original_name');
            $table->integer('ref_id')->unsigned();  
            $table->string('ref_type', 30);
            $table->mediumInteger('ordering')->nullable()->default(null);
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
        //
        Schema::dropIfExists('documents');
        Schema::dropIfExists('images_data'); 
        Schema::dropIfExists('images'); 
    }
}
