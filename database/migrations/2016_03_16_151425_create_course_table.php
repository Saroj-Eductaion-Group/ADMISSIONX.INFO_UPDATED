<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('course', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');

                $table->integer('degree_id')->unsigned()->nullable();
                $table->foreign('degree_id')->references('id')->on('degree')->onDelete('SET NULL');

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
        Schema::drop('course');
    }

}
