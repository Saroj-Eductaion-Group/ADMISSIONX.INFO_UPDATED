<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationstatusmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('applicationstatusmessages', function(Blueprint $table) {
                $table->increments('id');
                $table->string('application_id')->nullable();
                $table->string('student_id')->nullable();
                $table->string('college_id')->nullable();
                $table->string('admin_id')->nullable();
                $table->string('applicationStatus')->nullable();
                $table->text('message')->nullable();
                $table->string('others')->nullable();

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
        Schema::drop('applicationstatusmessages');
    }

}
