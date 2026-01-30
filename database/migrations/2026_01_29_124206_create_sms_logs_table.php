<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->string('mobile', 20);
            $table->text('message');
            $table->string('status', 50)->default('pending');
            $table->string('message_id')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();

            $table->index('mobile');
            $table->index('status');
            $table->index('message_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}
