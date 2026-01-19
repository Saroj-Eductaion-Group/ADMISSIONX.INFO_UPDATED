<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeOfExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_examinations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sortname')->nullable();
            $table->string('name')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug')->nullable();
            $table->string('universitylogo')->nullable();
            $table->string('universityName')->nullable();
            $table->integer('university_id')->nullable();
            $table->integer('examsection_id')->nullable();
            $table->integer('functionalarea_id')->nullable();
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
        Schema::drop('type_of_examinations');
    }
}
