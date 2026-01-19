<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhatWeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('what_we_offers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('iconImage')->nullable();
            $table->string('bannerText')->nullable();
            $table->string('bannerImage')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug')->nullable();
            $table->string('pageurl')->nullable();
            $table->integer('employee_id')->nullable();
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
        Schema::drop('what_we_offers');
    }
}
