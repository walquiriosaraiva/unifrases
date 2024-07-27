<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_nickname')->unsigned();
            $table->integer('to_nickname')->unsigned();
            $table->text('message');
            $table->integer('status');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            $table->foreign('from_nickname')->references('id')->on('chat_users')->onDelete('cascade');
            $table->foreign('to_nickname')->references('id')->on('chat_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
