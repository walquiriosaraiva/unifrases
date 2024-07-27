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
        Schema::create('frase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idioma')->nullable();
            $table->text('texto')->nullable();
            $table->char('status', 1)->nullable();
            $table->string('codigo', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frase');
    }
};
