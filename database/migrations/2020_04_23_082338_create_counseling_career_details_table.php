<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCareerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_career_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->longText('jobProfileDesc')->nullable();
            $table->integer('totalLikes')->nullable();
            $table->longText('pros')->nullable();
            $table->longText('cons')->nullable();
            $table->boolean('status')->default(0);
            $table->longText('futureGrowthPurpose')->nullable();
            $table->longText('employeeOpportunities')->nullable();
            $table->longText('studyMaterial')->nullable();
            $table->longText('whereToStudy')->nullable();
            $table->integer('functionalarea_id')->nullable();
            $table->string('slug')->nullable();
            $table->integer('careerRelevantId')->nullable();
            $table->timestamps();
            $table->integer('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counseling_career_details');
    }
}
