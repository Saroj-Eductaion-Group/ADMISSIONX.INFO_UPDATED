<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEngineeringExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineeringexams', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('fathername')->nullable();
            $table->string('category')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('choice1st')->nullable();
            $table->string('choice2nd')->nullable();
            $table->string('choice3rd')->nullable();
            $table->string('firstaddress1')->nullable();
            $table->string('firstaddress2')->nullable();
            $table->string('firstaddress3')->nullable();
            $table->string('firstcity')->nullable();
            $table->string('firststate')->nullable();
            $table->string('firstpincode')->nullable();
            $table->string('firstcontact')->nullable();
            $table->string('secondaddress1')->nullable();
            $table->string('secondaddress2')->nullable();
            $table->string('secondaddress3')->nullable();
            $table->string('secondcity')->nullable();
            $table->string('secondstate')->nullable();
            $table->string('secondpincode')->nullable();
            $table->string('secondcontact')->nullable();
            $table->boolean('addresssame')->nullable()->default(0);

            $table->string('board1')->nullable();
            $table->string('subject1')->nullable();
            $table->string('passingyr1')->nullable();
            $table->string('percentage1')->nullable();
            $table->string('cgpa1')->nullable();
            $table->string('division1')->nullable();

            $table->string('board2')->nullable();
            $table->string('subject2')->nullable();
            $table->string('passingyr2')->nullable();
            $table->string('percentage2')->nullable();
            $table->string('cgpa2')->nullable();
            $table->string('division2')->nullable();

            $table->boolean('iagree')->nullable()->default(0);

            $table->string('place')->nullable();
            $table->date('date')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('apikey')->nullable();
            $table->string('applicationId')->nullable();
            $table->string('examTransactionHashKey')->nullable();

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
        Schema::drop('engineeringexams');
    }
}
