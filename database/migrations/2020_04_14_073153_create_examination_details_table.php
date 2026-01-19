<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExaminationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('functionalarea_id')->nullable();
            $table->string('courses_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('applicationFrom')->nullable();
            $table->string('applicationTo')->nullable();
            $table->string('exminationDate')->nullable();
            $table->string('resultAnnounce')->nullable();
            $table->string('image')->nullable();
            $table->string('imagealttext')->nullable();
            $table->longText('content')->nullable();
            $table->string('getMoreInfoLink')->nullable();
            $table->integer('userId')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('totalLikes')->nullable();
            $table->integer('totalViews')->nullable();
            $table->integer('totalApplicationClick')->nullable();
            $table->integer('employee_id')->nullable();
            $table->longText('examEligibilityCriteria')->nullable();
            $table->longText('examDates')->nullable();
            $table->longText('mockTestDesc')->nullable();
            $table->longText('admidCardDesc')->nullable();
            $table->longText('admidCardInstructions')->nullable();
            $table->longText('examResultDesc')->nullable();
            $table->longText('examAnalysisDesc')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
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
        Schema::drop('examination_details');
    }
}
