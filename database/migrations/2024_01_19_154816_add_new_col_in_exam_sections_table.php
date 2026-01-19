<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNewColInExamSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_sections', function (Blueprint $table) {
            $table->boolean('isShowOnTop')->default(0)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowOnHome')->default(0)->comment="0-Disable,1-Enabled";
        });
    }
}
