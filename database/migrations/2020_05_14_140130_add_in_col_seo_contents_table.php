<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInColSeoContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seo_contents', function(Blueprint $table) {
            $table->integer('educationLevelId')->nullable();
            $table->integer('degreeId')->nullable();
            $table->integer('functionalAreaId')->nullable();
            $table->integer('topCourseId')->nullable();
            $table->integer('universityId')->nullable();
            $table->integer('countryId')->nullable();
            $table->integer('stateId')->nullable();
            $table->integer('cityId')->nullable();
            $table->integer('newsId')->nullable();
            $table->integer('newsTagId')->nullable();
            $table->integer('newsTypeId')->nullable();
            $table->integer('askQuestionId')->nullable();
            $table->integer('askTagId')->nullable();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}