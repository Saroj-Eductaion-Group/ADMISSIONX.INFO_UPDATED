<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('faculty', function(Blueprint $table) {
                $table->increments('id');
                $table->string('imagename')->nullable();
                $table->string('name')->nullable();
                $table->longText('description')->nullable();
                $table->text('sortorder')->nullable();
                $table->string('collegemaster_id')->nullable();
                $table->string('collegeprofile_id')->nullable();

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
        Schema::drop('faculty');
    }

}
