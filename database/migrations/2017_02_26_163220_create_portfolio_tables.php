<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //PORTFOLIO
        Schema::create('portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //RIFERIMENTO AL MODULO 
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU FRONT-END
            $table->enum('fav', ['1', '0'])->default('0');
            $table->date('date_from')->nullable()->default(null); 
            $table->date('date_to')->nullable()->default(null);          
            $table->string('place')->default('');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('portfolio_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('portfolio_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('portfolio_id')->references('id')->on('portfolio');
            $table->string('title');
            $table->string('subtitle')->default('');
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
        Schema::dropIfExists('portfolio_data');
        Schema::dropIfExists('portfolio');  
    }
}
