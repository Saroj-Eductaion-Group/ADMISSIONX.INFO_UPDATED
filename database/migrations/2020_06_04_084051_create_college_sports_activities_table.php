<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeSportsActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_sports_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('typeOfActivity')->nullable()->comment="1-Outdoor Sports,2-Indoor Sports,3-Co-curricular Activity";
            $table->longText('name')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('collegeprofile_id')->nullable();
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
        Schema::drop('college_sports_activities');
    }
}
