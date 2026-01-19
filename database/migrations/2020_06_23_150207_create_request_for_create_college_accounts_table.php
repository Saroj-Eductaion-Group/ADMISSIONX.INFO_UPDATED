<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestForCreateCollegeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_for_create_college_accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('collegeName')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('contactPersonName')->nullable();
            $table->integer('employee_id')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::drop('request_for_create_college_accounts');
    }
}
