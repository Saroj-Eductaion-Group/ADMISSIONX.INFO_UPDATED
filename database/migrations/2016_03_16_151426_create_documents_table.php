<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('documents', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('fullimage');
                $table->string('width');
                $table->string('height');
                $table->longText('description');

                $table->timestamps();
                $table->integer('employee_id')->nullable();
                
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('category')->onDelete('SET NULL');
                
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
        Schema::drop('documents');
    }

}
