<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaDeTemporadaTable extends Migration
{
    public function up()
    {
        Schema::create('guia_de_temporada', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->longText('descricao');
            $table->text('tags');
            $table->string('image')->nullable();
            $table->string('estacao');
            $table->integer('ano');
            $table->string('link');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guia_de_temporada');
    }
}
