<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('address', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('address1');
                $table->string('address2');
                $table->string('landmark');
                $table->string('postalcode');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('addresstype_id')->unsigned()->nullable();
                $table->foreign('addresstype_id')->references('id')->on('addresstype')->onDelete('SET NULL');

                $table->integer('city_id')->unsigned()->nullable();
                $table->foreign('city_id')->references('id')->on('city')->onDelete('SET NULL');

                $table->integer('studentprofile_id')->unsigned()->nullable();
                $table->foreign('studentprofile_id')->references('id')->on('studentprofile')->onDelete('SET NULL');

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
        Schema::drop('address');
    }

}
