<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubjectStudyLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('subject_study_levels', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('id_subject');
        $table->string('name_subjects');
        $table->string('id_study_levels');
        $table->string('name_study_levels');
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
        Schema::dropIfExists('subject_study_levels');
    }
}
