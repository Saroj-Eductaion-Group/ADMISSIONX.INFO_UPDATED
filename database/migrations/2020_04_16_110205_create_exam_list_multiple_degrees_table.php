<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamListMultipleDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_list_multiple_degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('degree_id')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
            $table->integer('examsection_id')->nullable();
            $table->integer('functionalarea_id')->nullable();
            $table->string('degreeSlug')->nullable();
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
        Schema::drop('exam_list_multiple_degrees');
    }
}
