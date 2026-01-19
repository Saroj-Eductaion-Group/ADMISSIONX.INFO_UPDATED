<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_question_answers', function(Blueprint $table) {
            $table->increments('id');
            $table->dateTime('answerDate')->nullable();
            $table->longText('answer')->nullable();
            $table->integer('questionId')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('share')->nullable();
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
        Schema::drop('exam_question_answers');
    }
}
