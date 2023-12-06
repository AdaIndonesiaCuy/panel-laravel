<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysTable extends Migration
{
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->string('key');
            $table->timestamp('date_generated');
            $table->integer('duration');
            $table->integer('max_device');
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('username'); // New column for username
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keys');
    }
}
