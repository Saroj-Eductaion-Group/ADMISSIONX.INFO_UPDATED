<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnCollegeprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collegeprofile', function (Blueprint $table) {
            $table->string('mediumOfInstruction')->nullable();
            $table->string('studyForm')->nullable();
            $table->string('studyTo')->nullable();
            $table->string('admissionStart')->nullable();
            $table->string('admissionEnd')->nullable();
            $table->boolean('CCTVSurveillance')->default(0)->comment="0-No,1-Yes";
            $table->string('totalStudent')->nullable();
            $table->boolean('ACCampus')->default(0)->comment="0-No,1-Yes";
            $table->double('rating',6,2)->default(0.00);
            $table->integer('totalRatingUser')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collegeprofile', function (Blueprint $table) {
            $table->dropColumn('mediumOfInstruction');
            $table->dropColumn('studyForm');
            $table->dropColumn('studyTo');
            $table->dropColumn('admissionStart');
            $table->dropColumn('admissionEnd');
            $table->dropColumn('CCTVSurveillance');
            $table->dropColumn('totalStudent');
            $table->dropColumn('ACCampus');
            $table->dropColumn('rating');
            $table->dropColumn('totalRatingUser');
        });
    }
}