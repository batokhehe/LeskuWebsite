<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('students', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('parent_name');
        $table->string('school_name');
        $table->string('school_class');
        $table->integer('level_id');
        $table->string('adress');
        $table->string('email');
        $table->string('phone_number');
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
        Schema::dropIfExists('students');
    }
}
