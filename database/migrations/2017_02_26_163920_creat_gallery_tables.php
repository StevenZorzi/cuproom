<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatGalleryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //GALLERY
        Schema::create('gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //RIFERIMENTO ALL'USER 
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU FRONT-END
            $table->enum('fav', ['1', '0'])->default('0');
            $table->string('product')->default('');  
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('gallery_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('gallery_id')->references('id')->on('gallery');
            $table->string('title');
            $table->string('period',70)->nullable()->default(null);
            $table->string('place',150)->nullable()->default(null);
            $table->text('description');
            $table->string('slug');
            $table->string('lang', 5); //SLUG LINGUA       
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
        Schema::dropIfExists('gallery_data');
        Schema::dropIfExists('gallery'); 
    }
}
