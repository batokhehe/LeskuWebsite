<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudyClassDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('study_class_details', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('study_class_id');
        $table->integer('subject_id');
        $table->integer('teacher_id');
        $table->timestamp('study_start_at')->nullable();
        $table->timestamp('studdy_end_at')->nullable();
        $table->string('rating')->nullable();
        $table->string('unique_code');
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
        Schema::dropIfExists('study_class_details');
    }
}
