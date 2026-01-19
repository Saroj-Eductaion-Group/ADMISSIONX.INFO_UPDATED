<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationAndExamStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_and_exam_statuses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('misc')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug')->nullable();
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
        Schema::drop('application_and_exam_statuses');
    }
}
