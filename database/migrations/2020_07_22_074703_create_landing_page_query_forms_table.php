<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLandingPageQueryFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_query_forms', function(Blueprint $table) {
            $table->increments('id');
            $table->string('fullname')->nullable();
            $table->string('mobilenumber')->nullable();
            $table->string('emailaddress')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('employee_id')->nullable();
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
        Schema::drop('landing_page_query_forms');
    }
}
