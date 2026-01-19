<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamApplicationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_application_fees', function(Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->string('quota')->nullable();
            $table->integer('mode')->nullable();
            $table->integer('gender')->nullable();
            $table->string('amount')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
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
        Schema::drop('exam_application_fees');
    }
}
