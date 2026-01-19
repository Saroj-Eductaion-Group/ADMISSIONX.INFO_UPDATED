<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('allTableInformation_id');
            $table->string('users_id');
            $table->boolean('create_action');
            $table->boolean('edit_action');
            $table->boolean('update_action');
            $table->boolean('delete_action');
            $table->boolean('show_action');
            $table->boolean('metrics1_action');
            $table->boolean('metrics2_action');
            $table->boolean('metrics3_action');
            $table->boolean('metrics4_action');
            $table->boolean('metrics5_action');
            $table->boolean('metrics6_action');
            $table->boolean('queries_action');
            $table->string('slug')->nullable();
            
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
        Schema::drop('usergroups');
    }

}
