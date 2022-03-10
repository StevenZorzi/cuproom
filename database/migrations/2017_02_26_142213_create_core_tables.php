<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 5); //SLUG LINGUA      
            $table->string('name', 20);
            $table->tinyInteger('ordering')->default('0')->unique();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();         // RIFERIMENTO PER CATEGORIA PADRE
            $table->timestamps();
        });

        Schema::create('categories_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name', 50);        
            $table->string('slug', 50);        
            $table->string('lang', 5); //SLUG LINGUA       
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();  
            $table->foreign('category_id')->references('id')->on('categories'); //I MODULI CORRISPONDONO AD UNA CATEGORIA PRINCIPALE (0)
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU AREA ADMIN 
            $table->string('roles', 40)->default(''); //ARRAY CHE CONTIENE I TIPI DI UTENTE CHE HANNO ACCESSO AL MODULO (superadmin , admin, user)
        });

        Schema::create('categories_assoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();  
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');  
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
        Schema::dropIfExists('categories_assoc');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('categories_data');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('languages');
        
    }
}
