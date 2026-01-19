<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCoursesEducationLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_courses_education_levels', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('educationlevel_id')->nullable();;
            $table->integer('functionalarea_id')->nullable();;
            $table->integer('coursesDetailsId')->nullable();;
            $table->string('educationLevelSlug')->nullable();;
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
        Schema::drop('counseling_courses_education_levels');
    }
}
