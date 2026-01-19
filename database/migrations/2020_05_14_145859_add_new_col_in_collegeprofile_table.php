<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColInCollegeprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collegeprofile', function (Blueprint $table) {
            $table->string('bannerimage')->nullable();
            $table->boolean('isShowOnTop')->default(1)->comment="0-Disable,1-Enabled";
            $table->boolean('isShowOnHome')->default(1)->comment="0-Disable,1-Enabled";
            $table->text('registeredSortAddress')->nullable();
            $table->text('registeredFullAddress')->nullable();
            $table->integer('registeredAddressCityId')->nullable();
            $table->integer('registeredAddressStateId')->nullable();
            $table->integer('registeredAddressCountryId')->nullable();
            $table->text('campusSortAddress')->nullable();
            $table->text('campusFullAddress')->nullable();
            $table->integer('campusAddressCityId')->nullable();
            $table->integer('campusAddressStateId')->nullable();
            $table->integer('campusAddressCountryId')->nullable();
        });
    }
}