<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 75)->nullable()->default(NULL);   
            $table->string('description', 155)->nullable()->default(NULL);
            $table->string('lang', 5); //SLUG LINGUA
            $table->integer('ref_id')->unsigned();
            $table->string('ref_type', 30);
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
        //Schema::dropIfExists('seo_data');
        Schema::dropIfExists('seo');
    }
}
