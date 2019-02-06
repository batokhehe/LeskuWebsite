<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudyClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('study_classes', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('product_id');
        $table->string('ordered_assembly');
        $table->string('ordered_subject');
        $table->string('trf_file')->nullable();
        $table->integer('status');
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
      Schema::dropIfExists('study_classes');
    }
}
