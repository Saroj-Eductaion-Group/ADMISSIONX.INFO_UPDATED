<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('subscribe', function(Blueprint $table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('name')->nullable();
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
        Schema::drop('subscribe');
    }

}
