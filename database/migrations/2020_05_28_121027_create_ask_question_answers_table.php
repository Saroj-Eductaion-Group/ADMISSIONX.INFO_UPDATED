<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAskQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_question_answers', function(Blueprint $table) {
            $table->increments('id');
            $table->longText('answer')->nullable();
            $table->dateTime('answerDate')->nullable();
            $table->integer('questionId')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('employee_id')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('share')->nullable();
            $table->integer('totalCommentsCount')->default(0);
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
        Schema::drop('ask_question_answers');
    }
}
