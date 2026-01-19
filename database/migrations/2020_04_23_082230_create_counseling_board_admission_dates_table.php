<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingBoardAdmissionDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_board_admission_dates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('place')->nullable();
            $table->string('dates')->nullable();
            $table->string('fees')->nullable();
            $table->string('class')->nullable();
            $table->string('subjects')->nullable();
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
        Schema::drop('counseling_board_admission_dates');
    }
}
