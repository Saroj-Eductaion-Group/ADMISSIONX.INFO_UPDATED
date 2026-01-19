<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('state', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('country_id')->unsigned()->nullable();
                $table->foreign('country_id')->references('id')->on('country')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('state');
    }

}
