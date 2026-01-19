<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_provider_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();

            $table->string('fb_provider_id')->nullable();
            $table->string('fb_token')->nullable();
            $table->string('fb_refresh_token')->nullable();
            $table->string('type_of_user')->nullable();
            $table->integer('is_emailSent')->default(1)->comment="0-No, 1-Yes";;
        });
    }
}
