<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCareerWhereToStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_career_where_to_studies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('instituteName')->nullable();
            $table->string('instituteUrl')->nullable();
            $table->string('city')->nullable();
            $table->string('programmeFees')->nullable();
            $table->integer('careerDetailsId')->nullable();
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
        Schema::drop('counseling_career_where_to_studies');
    }
}
