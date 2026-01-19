<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLatestUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latest_updates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->longText('desc')->nullable();
            $table->boolean('status')->nullable()->default(0)->comment="0-INACTIVE,1-ACTIVE";
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
        Schema::drop('latest_updates');
    }
}
