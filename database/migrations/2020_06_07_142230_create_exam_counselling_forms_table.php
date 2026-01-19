<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamCounsellingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_counselling_forms', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('misc')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->integer('isResponse')->nullable();
            $table->integer('isResponseMethod')->nullable();
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
        Schema::drop('exam_counselling_forms');
    }
}
