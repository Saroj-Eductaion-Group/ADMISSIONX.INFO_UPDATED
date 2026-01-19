<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialmanagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('socialmanagements', function(Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->text('description');
                $table->text('url');
                $table->boolean('isActive');
                $table->string('other');

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
        Schema::drop('socialmanagements');
    }

}
