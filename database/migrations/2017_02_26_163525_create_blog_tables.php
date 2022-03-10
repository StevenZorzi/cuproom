<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //BLOG
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //RIFERIMENTO AL MODULO 
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('active', ['1', '0'])->default('0');    // ATTIVAZIONE SU FRONT-END
            $table->enum('fav', ['1', '0'])->default('0');
            $table->date('date_from')->nullable()->default(null); 
            $table->date('date_to')->nullable()->default(null);               
            $table->string('time', 60)->nullable()->default(null);                
            $table->text('place')->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id')->unsigned();          // CHIAVE ESTERNA PER CATEGORIA PADRE
            $table->foreign('blog_id')->references('id')->on('blog');
            $table->string('title');
            $table->string('subtitle')->default('');
            $table->text('content');
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
        Schema::dropIfExists('blog_data');
        Schema::dropIfExists('blog');
    }
}
