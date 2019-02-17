<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Teacher extends Migration
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
        $table->timestamp('date_of_birth');
        $table->string('address')->nullable();
        $table->string('email');
        $table->string('phone_number')->nullable();
        $table->string('graduated')->nullable();
        $table->string('major')->nullable();
        $table->string('cv_file')->nullable();
        $table->string('certificate')->nullable();
        $table->string('id_card')->nullable();
        $table->integer('user_id');
        $table->string('image')->nullable();
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
