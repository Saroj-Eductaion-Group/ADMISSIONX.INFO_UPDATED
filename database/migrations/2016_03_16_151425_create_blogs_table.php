<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('blogs', function(Blueprint $table) {
                $table->increments('id');
                $table->string('topic');
                $table->string('featimage');
                $table->string('fullimage');
                $table->string('width');
                $table->string('height');
                $table->longText('description');
                $table->boolean('isactive');
                $table->string('slug');

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
        Schema::drop('blogs');
    }

}
