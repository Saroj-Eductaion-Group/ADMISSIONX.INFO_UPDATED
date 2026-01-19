<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('query', function(Blueprint $table) {
                $table->increments('id');
                $table->string('subject');
                $table->text('message');

                $table->integer('admin_id');
                $table->integer('college_id');
                $table->integer('student_id');

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
        Schema::drop('query');
    }

}
