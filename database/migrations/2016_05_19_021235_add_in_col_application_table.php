<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddInColApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::table('application', function(Blueprint $table) {
                $table->string('firstname');
                $table->string('middlename');
                $table->string('lastname');
                $table->date('dob');
                $table->string('email');
                $table->string('phone');
                $table->string('gender');
                $table->string('percent10');
                $table->string('marksheet10');
                $table->string('percent11');
                $table->string('marksheet11');
                $table->string('percent12');
                $table->string('marksheet12');
                $table->string('parentname');
                $table->string('parentnumber');
                $table->string('parentidproof');
                $table->string('hobbies');
                $table->string('interest');
                $table->string('awards');
                $table->string('projects');
                $table->string('iagreeparents');
                $table->string('iagreeform');
                $table->string('totalfees');
                $table->string('byafees');
                $table->string('restfees');


                $table->integer('collegemaster_id')->unsigned()->nullable();
                $table->foreign('collegemaster_id')->references('id')->on('collegemaster')->onDelete('SET NULL');

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
