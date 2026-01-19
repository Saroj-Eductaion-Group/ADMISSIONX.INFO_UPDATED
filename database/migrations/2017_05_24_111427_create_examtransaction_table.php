<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamtransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('examtransaction', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('studentname');
                $table->string('amount');
                $table->string('examTransactionHashKey')->nullable();
                
                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('paymentstatus_id')->unsigned()->nullable();
                $table->foreign('paymentstatus_id')->references('id')->on('paymentstatus')->onDelete('SET NULL');

                $table->integer('cardtype_id')->unsigned()->nullable();
                $table->foreign('cardtype_id')->references('id')->on('cardtype')->onDelete('SET NULL');

                $table->integer('engineeringexams_id')->unsigned()->nullable();
                $table->foreign('engineeringexams_id')->references('id')->on('engineeringexams')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('examtransaction');
    }

}
