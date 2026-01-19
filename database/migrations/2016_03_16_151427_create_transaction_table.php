<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('transaction', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('transactionHashKey')->nullable();

                $table->timestamps();
                $table->integer('employee_id')->nullable();

                $table->integer('paymentstatus_id')->unsigned()->nullable();
                $table->foreign('paymentstatus_id')->references('id')->on('paymentstatus')->onDelete('SET NULL');

                $table->integer('cardtype_id')->unsigned()->nullable();
                $table->foreign('cardtype_id')->references('id')->on('cardtype')->onDelete('SET NULL');

                $table->integer('application_id')->unsigned()->nullable();
                $table->foreign('application_id')->references('id')->on('application')->onDelete('SET NULL');
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction');
    }

}
