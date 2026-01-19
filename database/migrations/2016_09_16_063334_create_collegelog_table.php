<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('collegelog', function(Blueprint $table) {
                $table->increments('id');
                
                $table->integer('college_id');
                $table->integer('student_id');
                $table->integer('users_id');
                $table->string('event');
                $table->integer('userrole_id')->nullable();
                $table->string('ipaddress');

                $table->timestamps();
                $table->integer('employee_id')->nullable();
                $table->integer('course_id')->nullable();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collegelog');
    }

}
