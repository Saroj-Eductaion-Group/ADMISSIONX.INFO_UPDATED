<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultyQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_qualifications', function(Blueprint $table) {
            $table->increments('id');
            $table->string('qualification')->nullable();
            $table->string('course')->nullable();
            $table->string('subjects')->nullable();
            $table->string('collegename')->nullable();
            $table->string('boardName')->nullable();
            $table->integer('year')->nullable();
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
        Schema::drop('faculty_qualifications');
    }
}
