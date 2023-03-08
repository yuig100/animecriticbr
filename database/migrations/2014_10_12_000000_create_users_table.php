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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname',100)->unique();
            $table->string('nome');
            $table->string('email',190)->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('bio',200)->nullable();
            $table->string('localizacao')->nullable();
            $table->string('genero')->nullable()->comment('1 para homem | 0 para mulher');
            $table->integer('tipo')->default(0)->comment('0 para normal| 1 para Moderador | 2 para Editor | 3 para Adm');
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
