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
        Schema::create('anime_calendario', function (Blueprint $table) {
            $table->id();
            $table->string('estacao', 50)->nullable();
            $table->integer('ano')->nullable();
            $table->string('nome_anime',240)->nullable();
            $table->foreign('nome_anime')->references('nome')->on('animes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_calendario');
    }
};
