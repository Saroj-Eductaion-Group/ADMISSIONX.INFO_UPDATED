<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserprivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('userprivileges', function(Blueprint $table) {
                $table->increments('id');
                $table->string('allTableInformation_id');
                $table->boolean('create');
                $table->boolean('edit');
                $table->boolean('update');
                $table->boolean('delete');
                $table->boolean('show');
                $table->boolean('metrics1');
                $table->boolean('metrics2');
                $table->boolean('metrics3');
                $table->boolean('metrics4');
                $table->boolean('metrics5');
                $table->boolean('metrics6');
                $table->boolean('queries');

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
        Schema::drop('userprivileges');
    }

}
