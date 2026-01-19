<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_contents', function(Blueprint $table) {
            $table->increments('id');
            $table->text('pagetitle')->nullable();
            $table->text('description')->nullable();
            $table->text('keyword')->nullable();
            $table->text('misc')->nullable();
            $table->text('slugurl')->nullable();
            $table->text('h1title')->nullable();
            $table->text('canonical')->nullable();
            $table->text('h2title')->nullable();
            $table->text('h3title')->nullable();
            $table->text('image')->nullable();
            $table->text('imagealttext')->nullable();
            $table->text('content')->nullable();
            $table->integer('pageId')->nullable();
            $table->integer('userId')->nullable();
            $table->integer('collegeId')->nullable();
            $table->integer('examId')->nullable();
            $table->integer('boardId')->nullable();
            $table->integer('careerReleventId')->nullable();
            $table->integer('popularCareerId')->nullable();
            $table->integer('courseId')->nullable();
            $table->integer('blogId')->nullable();
            $table->integer('examSectionId')->nullable();
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
        Schema::drop('seo_contents');
    }
}
