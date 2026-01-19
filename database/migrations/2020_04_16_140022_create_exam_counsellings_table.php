<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamCounsellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_counsellings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degreeId')->nullable();
            $table->string('degreeName')->nullable();
            $table->integer('modeofcounselling')->nullable();
            $table->longText('description')->nullable();
            $table->longText('counsellingProcedure')->nullable();
            $table->longText('documentsRequired')->nullable();
            $table->text('websiteLink')->nullable();
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
        Schema::drop('exam_counsellings');
    }
}
