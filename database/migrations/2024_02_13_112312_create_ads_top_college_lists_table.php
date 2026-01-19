<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTopCollegeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_top_college_lists', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('method_type')->index()->nullable();
            $table->string('collegeprofile_id')->index()->nullable();
            $table->integer('functionalarea_id')->index()->nullable();
            $table->integer('degree_id')->index()->nullable();
            $table->integer('course_id')->index()->nullable();
            $table->integer('educationlevel_id')->index()->nullable();
            $table->integer('city_id')->index()->nullable();
            $table->integer('state_id')->index()->nullable();
            $table->integer('country_id')->index()->nullable();
            $table->integer('university_id')->index()->nullable();
            $table->integer('employee_id')->index()->nullable();
            $table->boolean('status')->index()->default(0)->comment="0-INACTIVE,1-ACTIVE";
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
        Schema::drop('ads_top_college_lists');
    }
}
