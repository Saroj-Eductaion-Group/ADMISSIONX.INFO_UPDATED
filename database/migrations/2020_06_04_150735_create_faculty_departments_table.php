<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultyDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_departments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('collegemaster_id')->nullable();
            $table->integer('functionalarea_id')->nullable();
            $table->integer('educationlevel_id')->nullable();
            $table->integer('degree_id')->nullable();
            $table->integer('coursetype_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('collegeprofile_id')->nullable();
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
        Schema::drop('faculty_departments');
    }
}
