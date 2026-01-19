<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('city', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');

                $table->timestamps();
                $table->integer('employee_id')->nullable();
                $table->boolean('cityStatus')->default(0);
                
                $table->integer('state_id')->unsigned()->nullable();
                $table->foreign('state_id')->references('id')->on('state')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('city');
    }

}
