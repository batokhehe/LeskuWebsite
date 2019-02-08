<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Teachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('teachers', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('adress');
        $table->string('email');
        $table->string('phone_number');
        $table->string('cv_file');
        $table->string('certificate');
        $table->integer('user_id');
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
        Schema::dropIfExists('teachers');
    }
}