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
        Schema::create('idioma', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->nullable();
            $table->string('encoding', 100)->nullable();
            $table->string('collateaux', 100)->nullable();
            $table->char('status', 1)->nullable();
            $table->string('imagem', 100)->nullable();
            $table->string('link', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idioma');
    }
};
