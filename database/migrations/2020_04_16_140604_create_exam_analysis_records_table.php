<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamAnalysisRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_analysis_records', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degreeId')->nullable();
            $table->string('degreeName')->nullable();
            $table->longText('description')->nullable();
            $table->string('papername')->nullable();
            $table->string('files')->nullable();
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
        Schema::drop('exam_analysis_records');
    }
}
