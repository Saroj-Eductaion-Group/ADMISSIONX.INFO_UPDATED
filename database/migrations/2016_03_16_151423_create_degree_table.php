<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDegreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('degree', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');

                $table->integer('functionalarea_id')->unsigned()->nullable();
                $table->foreign('functionalarea_id')->references('id')->on('functionalarea')->onDelete('SET NULL');
                
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
        Schema::drop('degree');
    }

}
