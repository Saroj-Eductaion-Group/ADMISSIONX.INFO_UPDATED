<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('invite', function(Blueprint $table) {
                $table->increments('id');
                $table->string('link');
                $table->string('referemail');
                $table->boolean('isactive');

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('users_id')->unsigned()->nullable();
                $table->foreign('users_id')->references('id')->on('users')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invite');
    }

}
