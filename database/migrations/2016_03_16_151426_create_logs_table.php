<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('logs', function(Blueprint $table) {
                $table->increments('id');
                
                $table->integer('users_id');
                $table->string('event');
                $table->integer('userrole_id')->nullable();
                $table->string('ipaddress');

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
        Schema::drop('logs');
    }

}
