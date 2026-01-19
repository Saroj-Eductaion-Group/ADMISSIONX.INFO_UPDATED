<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInColExamApplicationProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_application_processes', function(Blueprint $table) {
            $table->integer('examinationtype')->nullable();
            $table->integer('applicationandexamstatus')->nullable();
            $table->integer('examinationmode')->nullable();
            $table->integer('eligibilitycriteria')->nullable();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}