<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultyExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_experiences', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('fromyear')->nullable();
            $table->integer('toyear')->nullable();
            $table->string('role')->nullable();
            $table->string('organisation')->nullable();
            $table->string('city')->nullable();
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
        Schema::drop('faculty_experiences');
    }
}
