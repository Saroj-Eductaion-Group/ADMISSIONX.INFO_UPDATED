<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegeReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('votes')->nullable();
            $table->double('academic',6,2)->default(0.00);
            $table->double('accommodation',6,2)->default(0.00);
            $table->double('faculty',6,2)->default(0.00);
            $table->double('infrastructure',6,2)->default(0.00);
            $table->double('placement',6,2)->default(0.00);
            $table->double('social',6,2)->default(0.00);
            $table->integer('guestUserId')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('collegeprofile_id')->nullable();
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
        Schema::drop('college_reviews');
    }
}
