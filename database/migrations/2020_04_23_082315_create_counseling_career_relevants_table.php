<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCareerRelevantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_career_relevants', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(0);
            $table->string('salery')->nullable();
            $table->string('stream')->nullable();
            $table->string('mandatorySubject')->nullable();
            $table->string('academicDifficulty')->nullable();
            $table->integer('careerInterest')->nullable();
            $table->integer('functionalarea_id')->nullable();
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
        Schema::drop('counseling_career_relevants');
    }
}
