<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColInDegreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('degree', function (Blueprint $table) {
            $table->string('pagetitle')->nullable();
            $table->longText('pagedescription')->nullable();
            $table->text('pageslug')->nullable();
            $table->string('logoimage')->nullable();
            $table->string('bannerimage')->nullable();
            $table->boolean('isShowOnTop')->default(1)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowOnHome')->default(1)->comment="0-Disable,1-Enabled";
        });
    }
}