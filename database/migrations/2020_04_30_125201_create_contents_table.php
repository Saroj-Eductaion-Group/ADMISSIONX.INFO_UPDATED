<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->boolean('status');
            $table->string('contentslug');
            $table->timestamps();

            $table->integer('contentcategory_id')->unsigned()->nullable();
            $table->foreign('contentcategory_id')->references('id')->on('contentcategory')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contents');
    }
}
