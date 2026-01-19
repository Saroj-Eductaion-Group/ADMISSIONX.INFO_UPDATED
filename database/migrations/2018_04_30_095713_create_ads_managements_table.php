<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_managements', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->boolean('isactive')->default(0)->comment="0-INACTIVE,1-ACTIVE";
            $table->string('slug')->nullable();
            $table->integer('users_id')->nullable();

            $table->string('redirectto')->nullable();
            $table->string('ads_position')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();

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
        Schema::drop('ads_managements');
    }
}
