<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamCutOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_cut_offs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degreeId')->nullable();
            $table->string('degreeName')->nullable();
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
        Schema::drop('exam_cut_offs');
    }
}
