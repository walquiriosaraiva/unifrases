<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkTables extends Migration
{

    public function up()
    {
        Schema::table('chat_messages', function ($table) {
            $table->foreign('from_nickname')->references('id')->on('chat_users')->onDelete('cascade');
            $table->foreign('to_nickname')->references('id')->on('chat_users')->onDelete('cascade');
        });
    }

    public function down()
    {
        //
    }
}
