<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAskQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_questions', function(Blueprint $table) {
            $table->increments('id');
            $table->longText('question')->nullable();
            $table->dateTime('questionDate')->nullable();
            $table->integer('userId')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('employee_id')->nullable();
            $table->longText('slug')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('share')->default(0);
            $table->integer('views')->default(0);
            $table->integer('totalAnswerCount')->default(0);
            $table->integer('totalCommentsCount')->default(0);
            $table->string('askQuestionTagIds')->nullable();
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
        Schema::drop('ask_questions');
    }
}
