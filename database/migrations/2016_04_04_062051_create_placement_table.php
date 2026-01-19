<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlacementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('placement', function(Blueprint $table) {
                $table->increments('id');
                $table->string('numberofrecruitingcompany');
                $table->string('numberofplacementlastyear');
                $table->string('ctchighest');
                $table->string('ctclowest');
                $table->string('ctcaverage');
                $table->longText('placementinfo');
                $table->integer('employee_id')->nullable();

                $table->integer('collegeprofile_id')->unsigned()->nullable();
                $table->foreign('collegeprofile_id')->references('id')->on('collegeprofile')->onDelete('SET NULL');

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
        Schema::drop('placement');
    }

}
