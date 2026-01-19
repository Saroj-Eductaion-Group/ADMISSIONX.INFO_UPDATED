<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('studentprofile', function(Blueprint $table) {
                $table->increments('id');
                $table->string('gender');
                $table->date('dateofbirth');
                $table->string('parentsname');
                $table->string('parentsnumber');
                $table->string('hobbies');
                $table->string('interests');
                $table->longText('achievementsawards');
                $table->longText('projects');
                $table->string('entranceexamname');
                $table->string('entranceexamnumber');
                $table->boolean('isverifiedage')->default(0);
                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('users_id')->unsigned()->nullable();
                $table->foreign('users_id')->references('id')->on('users')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studentprofile');
    }

}
