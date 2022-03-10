<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        //VARIANTI PRODOTTO
        Schema::create('variants', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['size', 'color']);                 // CATEGORIA VARIANTE
            $table->tinyInteger('ordering')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('variants_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variant_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade');
            $table->string('name', 50);        
            $table->string('lang', 5); //SLUG LINGUA       
            $table->timestamps();
        });

        //BRANDS 
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU FRONT-END
            $table->enum('fav', ['1', '0'])->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('brands_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('name', 70);
            $table->text('description');
            $table->string('slug');
            $table->string('lang', 5); //SLUG LINGUA       
            $table->timestamps();
        });

        Schema::create('brands_assoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();  
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');  
            $table->integer('ref_id')->unsigned();  
            $table->string('ref_type', 30);
            $table->timestamps(); 
        });

        //PRODOTTI
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //RIFERIMENTO AL MODULO 
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU FRONT-END
            $table->enum('fav', ['1', '0'])->default('0');
            $table->integer('parent_id')->unsigned()->nullable()->default(null); // RIFERIMENTO AL PRODOTTO BASE NEL CASO DI VARIANTE
            $table->string('code', 50)->nullable()->default(NULL);
            $table->decimal('price', 5, 2)->nullable()->default(NULL); 
            $table->string('dimensions', 100);
            $table->string('size')->default('');                                // ARRAY SERIALIZZATO PER COLLEGAMENTO VARIANTI TAGLIE
            $table->string('color')->default('');                               // ARRAY SERIALIZZATO PER COLLEGAMENTO VARIANTI COLORE
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('name');
            $table->text('description');
            $table->text('data_sheet');
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
        Schema::dropIfExists('products_data');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands_assoc');
        Schema::dropIfExists('brands_data');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('variants_data');
        Schema::dropIfExists('variants');
        
    }
}
