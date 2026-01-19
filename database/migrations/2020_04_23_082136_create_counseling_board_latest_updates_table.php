<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingBoardLatestUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_board_latest_updates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('dates')->nullable();
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
        Schema::drop('counseling_board_latest_updates');
    }
}
