<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddInColPaymentApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::table('application', function(Blueprint $table) {
                $table->integer('paymentstatus_id')->nullable();
                $table->string('applicationID')->nullable();
                $table->dateTime('lastPaymentAttemptDate')->nullable();
                $table->string('misc')->nullable();

            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }

}
