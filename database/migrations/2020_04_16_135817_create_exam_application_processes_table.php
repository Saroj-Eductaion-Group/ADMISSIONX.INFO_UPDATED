<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamApplicationProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_application_processes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('modeofapplication')->nullable();
            $table->integer('modeofpayment')->nullable();
            $table->longText('description')->nullable();
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
        Schema::drop('exam_application_processes');
    }
}
