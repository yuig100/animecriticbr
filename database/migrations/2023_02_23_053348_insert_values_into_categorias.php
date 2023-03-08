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
        DB::table('categorias')->insert([
        [
            'id' => '1',
            'nome' => 'Notícia',
            'descrição' => 'Notícia'
        ],
        [
            'id' => '2',
            'nome' => 'Analise',
            'descrição' => 'Analise',
        ],
        [
            'id' => '3',
            'nome' => 'Guia de Temporada',
            'descrição' => 'Categoria que aborda o guia de temporada',
        ],
        [
            'id' => '4',
            'nome' => 'Manga',
            'descrição' => 'Manga',
        ],
        [
            'id' => '5',
            'nome' => 'Ranking de Venda',
            'descrição' => 'ranking de venda de mangas,light novels,blu-rays e etc...',
        ],
        [
            'id' => '6',
            'nome' => 'Compras',
            'descrição' => 'promoções ou divulgações de produtos',
        ],
        [
            'id' => '7',
            'nome' => 'Ranking Japonês',
            'descrição' => 'Rankings feitos pelos japones',
        ],
        [
            'id' => '8',
            'nome' => 'Ranking BR',
            'descrição' => 'rankings brasileiros',
        ],
    ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categorias')->truncate();
    }
};
