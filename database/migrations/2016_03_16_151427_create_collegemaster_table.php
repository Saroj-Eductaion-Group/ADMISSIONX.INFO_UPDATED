<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegemasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('collegemaster', function(Blueprint $table) {
                $table->increments('id');
                $table->string('twelvemarks');
                $table->string('others');
                $table->string('fees');
                $table->string('seats');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('collegeprofile_id')->unsigned()->nullable();
                $table->foreign('collegeprofile_id')->references('id')->on('collegeprofile')->onDelete('SET NULL');

                $table->integer('educationlevel_id')->unsigned()->nullable();
                $table->foreign('educationlevel_id')->references('id')->on('educationlevel')->onDelete('SET NULL');

                $table->integer('functionalarea_id')->unsigned()->nullable();
                $table->foreign('functionalarea_id')->references('id')->on('functionalarea')->onDelete('SET NULL');

                $table->integer('degree_id')->unsigned()->nullable();
                $table->foreign('degree_id')->references('id')->on('degree')->onDelete('SET NULL');

                $table->integer('coursetype_id')->unsigned()->nullable();
                $table->foreign('coursetype_id')->references('id')->on('coursetype')->onDelete('SET NULL');

                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id')->references('id')->on('course')->onDelete('SET NULL');

            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collegemaster');
    }

}
