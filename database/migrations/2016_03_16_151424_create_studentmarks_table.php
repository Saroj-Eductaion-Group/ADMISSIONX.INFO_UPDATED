<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('studentmarks', function(Blueprint $table) {
                $table->increments('id');
                $table->string('marks');
                $table->string('percentage');

                $table->timestamps();
                $table->integer('employee_id')->nullable();
                $table->string('studentMarkType')->nullable();
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('category')->onDelete('SET NULL');

                $table->integer('studentprofile_id')->unsigned()->nullable();
                $table->foreign('studentprofile_id')->references('id')->on('studentprofile')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('studentmarks');
    }

}
