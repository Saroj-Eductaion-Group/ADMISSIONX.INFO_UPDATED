<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('careers', function(Blueprint $table) {
                $table->increments('id');
                $table->string('firstname');
                $table->string('middlename');
                $table->string('lastname');
                $table->string('email');
                $table->date('dateOfBirth');
                $table->string('gender');
                $table->string('phonenumber');
                $table->string('address');
                $table->string('pincode');
                $table->string('cv');
                $table->string('postappliedfor');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('city_id')->unsigned()->nullable();
                $table->foreign('city_id')->references('id')->on('city')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('careers');
    }

}
