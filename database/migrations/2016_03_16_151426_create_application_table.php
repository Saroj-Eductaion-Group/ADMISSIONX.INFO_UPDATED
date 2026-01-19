<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('application', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('transactionHashKey')->nullable();

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('applicationstatus_id')->unsigned()->nullable();
                $table->foreign('applicationstatus_id')->references('id')->on('applicationstatus')->onDelete('SET NULL');

                $table->integer('users_id')->unsigned()->nullable();
                $table->foreign('users_id')->references('id')->on('users')->onDelete('SET NULL');

                $table->integer('collegeprofile_id')->unsigned()->nullable();
                $table->foreign('collegeprofile_id')->references('id')->on('collegeprofile')->onDelete('SET NULL');

            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('application');
    }

}
