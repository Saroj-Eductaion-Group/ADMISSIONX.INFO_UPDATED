<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNewColApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application', function(Blueprint $table) {
            $table->string('graduationPercent')->nullable();
            $table->string('graduationMarksheet')->nullable();
        });            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application', function(Blueprint $table) {
            $table->dropColumn('graduationPercent');
            $table->dropColumn('graduationMarksheet');
        });
    }
}
