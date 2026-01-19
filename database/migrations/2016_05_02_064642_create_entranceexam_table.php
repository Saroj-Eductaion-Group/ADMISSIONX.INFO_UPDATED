<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntranceexamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('entranceexam', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->longText('description');

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
        Schema::drop('entranceexam');
    }

}
