<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColInTypeOfExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_of_examinations', function (Blueprint $table) {
            $table->boolean('isShowOnTop')->default(0)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowOnHome')->default(0)->comment="0-Disable,1-Enabled";
        });
    }
}
