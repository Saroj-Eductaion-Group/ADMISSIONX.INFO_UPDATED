<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCounselingCareerJobRoleSaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_career_job_role_saleries', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('avgSalery')->nullable();
            $table->longText('topCompany')->nullable();
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
        Schema::drop('counseling_career_job_role_saleries');
    }
}
