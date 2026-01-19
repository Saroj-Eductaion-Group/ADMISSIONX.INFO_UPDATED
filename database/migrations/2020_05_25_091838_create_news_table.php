<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            $table->string('topic')->nullable();
            $table->string('featimage')->nullable();
            $table->string('fullimage')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('isactive')->nullable();
            $table->string('slug')->nullable();
            $table->string('newstypeids')->nullable();
            $table->string('newstagsids')->nullable();
            $table->integer('users_id')->nullable();
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
        Schema::drop('news');
    }
}
