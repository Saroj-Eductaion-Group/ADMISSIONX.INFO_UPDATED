<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegefacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('collegefacilities', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->longText('description');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('collegeprofile_id')->unsigned()->nullable();
                $table->foreign('collegeprofile_id')->references('id')->on('collegeprofile')->onDelete('SET NULL');

                $table->integer('facilities_id')->unsigned()->nullable();
                $table->foreign('facilities_id')->references('id')->on('facilities')->onDelete('SET NULL');

            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collegefacilities');
    }

}
