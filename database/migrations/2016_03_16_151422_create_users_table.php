<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('users', function(Blueprint $table) {
                $table->increments('id');
                $table->string('suffix', 10);
                $table->string('firstname');
                $table->string('middlename');
                $table->string('lastname');
                $table->string('phone');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('remember_token');
                $table->string('token');
                $table->timestamps();
                $table->integer('employee_id')->nullable();
                $table->string('apikey')->nullable();

                $table->integer('userstatus_id')->unsigned()->nullable();
                $table->foreign('userstatus_id')->references('id')->on('userstatus')->onDelete('SET NULL');

                $table->integer('userrole_id')->unsigned()->nullable();
                $table->foreign('userrole_id')->references('id')->on('userrole')->onDelete('SET NULL');

            });
            

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
