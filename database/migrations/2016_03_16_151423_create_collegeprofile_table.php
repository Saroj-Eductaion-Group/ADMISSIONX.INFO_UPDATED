<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('collegeprofile', function(Blueprint $table) {
                $table->increments('id');
                $table->longText('description');
                $table->string('estyear');
                $table->string('website');
                $table->string('collegecode');
                $table->string('contactpersonname');
                $table->string('contactpersonemail');
                $table->string('contactpersonnumber');
                $table->boolean('review')->default(0);
                $table->boolean('agreement')->default(0);
                $table->boolean('verified')->default(0);
                $table->longText('calenderinfo');
                $table->string('approvedBy');
                
                $table->string('slug');

                $table->datetime('advertisementTimeFrame')->nullable();
                $table->datetime('advertisementTimeFrameEnd')->nullable();
                
                
                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('users_id')->unsigned()->nullable();
                $table->foreign('users_id')->references('id')->on('users')->onDelete('SET NULL');

                $table->integer('university_id')->unsigned()->nullable();
                $table->foreign('university_id')->references('id')->on('university')->onDelete('SET NULL');

                $table->integer('collegetype_id')->unsigned()->nullable();
                $table->foreign('collegetype_id')->references('id')->on('collegetype')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collegeprofile');
    }

}
