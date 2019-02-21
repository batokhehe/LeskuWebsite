<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudyClassDetail extends Migration
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
        $table->timestamp('study_start_at')->nullable()->default(null);
        $table->timestamp('study_end_at')->nullable()->default(null);
        $table->string('rating')->nullable();
        $table->string('unique_code');
        $table->integer('status')->default(0);
        $table->integer('student_status')->default(0);
        $table->string('reason')->nullable();
        $table->string('submitter')->nullable();
        $table->integer('rescheduled')->default(0);
        $table->string('comment')->nullable();
        $table->integer('change_teacher')->default(0);
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
