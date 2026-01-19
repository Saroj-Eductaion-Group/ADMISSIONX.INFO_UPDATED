<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_patterns', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degreeId')->nullable();
            $table->string('degreeName')->nullable();
            $table->longText('patternDesc')->nullable();
            $table->integer('modeOfExam')->nullable();
            $table->string('examDuration')->nullable();
            $table->integer('totalQuestion')->nullable();
            $table->integer('totalMarks')->nullable();
            $table->string('section')->nullable();
            $table->longText('markingSchem')->nullable();
            $table->string('languageofpaper')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
            $table->integer('employee_id')->nullable();
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
        Schema::drop('exam_patterns');
    }
}
