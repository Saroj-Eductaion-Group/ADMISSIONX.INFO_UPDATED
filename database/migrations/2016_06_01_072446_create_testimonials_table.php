<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('testimonials', function(Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('author');
                $table->string('featuredimage');
                $table->text('description');
                $table->text('misc');
                $table->string('slug');

                $table->timestamps();
                $table->integer('employee_id')->nullable();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('testimonials');
    }

}
