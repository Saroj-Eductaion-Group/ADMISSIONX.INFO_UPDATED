<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeAdmissionImportantDatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_admission_important_dateds', function(Blueprint $table) {
            $table->increments('id');
            $table->string('fromdate')->nullable();
            $table->string('todate')->nullable();
            $table->text('eventName')->nullable();
            $table->integer('collegeAdmissionProcedure_id')->nullable();
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
        Schema::drop('college_admission_important_dateds');
    }
}
