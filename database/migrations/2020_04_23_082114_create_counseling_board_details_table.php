<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingBoardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_board_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->longText('aboutBoard')->nullable();
            $table->longText('admissionDesc')->nullable();
            $table->longText('boardDesc')->nullable();
            $table->longText('syllabusDesc')->nullable();
            $table->longText('samplePaper')->nullable();
            $table->longText('admitCardDetails')->nullable();
            $table->longText('preprationTips')->nullable();
            $table->longText('resultDesc')->nullable();
            $table->longText('entranceExam')->nullable();
            $table->longText('chooseRightCollege')->nullable();
            $table->integer('counselingBoardId')->nullable();
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
        Schema::drop('counseling_board_details');
    }
}
