<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCoursesMoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_courses_more_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('popularCities')->nullable();
            $table->string('specialisations')->nullable();
            $table->string('entranceExamsName')->nullable();
            $table->integer('coursesDetailsId')->nullable();
            $table->integer('functionalarea_id')->nullable();
            $table->integer('degree_id')->nullable();
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
        Schema::drop('counseling_courses_more_details');
    }
}
