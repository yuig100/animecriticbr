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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->longText('comentario');
            $table->timestamps();
            $table->boolean('visivel')->default(true);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_publicacao');
            $table->unsignedBigInteger('id_parent')->nullable();
            $table->integer('up_votos')->default(0);
            $table->integer('down_votos')->default(0);

            $table->string('publicacao_type');

            $table->foreign('id_parent')->references('id')->on('comentarios')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_publicacao')->references('id')->on('publicacoes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
};
