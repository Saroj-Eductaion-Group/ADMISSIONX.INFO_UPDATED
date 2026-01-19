<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingBoardSamplePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_board_sample_papers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('class')->nullable();
            $table->string('subject')->nullable();
            $table->longText('description')->nullable();
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
        Schema::drop('counseling_board_sample_papers');
    }
}
