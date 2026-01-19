<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExaminationImportantLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_important_links', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('url')->nullable();
            $table->integer('examinationDetailsId')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('typeOfExaminations_id')->nullable();
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
        Schema::drop('examination_important_links');
    }
}
