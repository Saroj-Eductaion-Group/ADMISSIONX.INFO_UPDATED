<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_managers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sliderTitle')->nullable();
            $table->string('bottomText')->nullable();
            $table->string('sliderImage')->nullable();
            $table->text('bottomLink')->nullable();
            $table->string('scrollerFirstText')->nullable();
            $table->string('scrollerLastText')->nullable();
            $table->boolean('status')->default(0)->comment="0-INACTIVE,1-ACTIVE";
            $table->boolean('isShowCollegeCount')->default(0)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowExamCount')->default(0)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowCourseCount')->default(0)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowBlogCount')->default(0)->comment="0-Disable,1-Enabled";
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
        Schema::drop('slider_managers');
    }
}
