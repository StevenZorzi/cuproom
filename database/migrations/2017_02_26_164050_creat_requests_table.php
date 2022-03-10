<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //REQUESTS
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', 150)->default('');
            $table->string('name', 30)->default('');
            $table->string('surname', 30)->default('');
            $table->string('company', 60)->default('');
            $table->string('email')->default('');
            $table->string('phone')->default('');
            $table->text('message');
            $table->enum('response', ['1', '0'])->default('0');
            $table->integer('ref_id')->unsigned()->nullable()->default(null);  
            $table->string('ref_type', 30)->nullable()->default(null);
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
        Schema::dropIfExists('requests');
    }
}
