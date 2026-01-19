<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColInCounselingCareerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counseling_career_details', function (Blueprint $table) {
            $table->longText('purpose_desc')->nullable();
            $table->longText('eligibility')->nullable();
            $table->longText('qualification')->nullable();
            $table->longText('syllabus')->nullable();
            $table->longText('exam_pattern')->nullable();
            $table->longText('selection_criteria')->nullable();
            $table->longText('frequency')->nullable();
            $table->longText('other_details')->nullable();
        });
    }
}
