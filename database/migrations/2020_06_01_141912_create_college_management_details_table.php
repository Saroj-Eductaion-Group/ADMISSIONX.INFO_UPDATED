<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_management_details', function(Blueprint $table) {
            $table->increments('id');
            $table->string('suffix', 30)->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->integer('gender')->nullable();
            $table->string('picture')->nullable();
            $table->string('emailaddress')->nullable();
            $table->string('phoneno')->nullable();
            $table->string('landlineNo')->nullable();
            $table->longText('about')->nullable();
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
        Schema::drop('college_management_details');
    }
}
