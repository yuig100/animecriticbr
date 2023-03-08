<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

use App\Models\Noticia;
use App\Models\Analise;
use Carbon\Carbon;

require_once base_path('vendor\autoload.php');

class TestController extends Controller
{
    public function test(){
        return view('teste');
    }

    public function test2(){
        /*
        for($i=17;$i<200;$i++){

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $analises = new Analise;
        $analises->titulo =  'Teste '.$i;
        $analises->descricao = 'Descrição do Teste '.$i;
        $analises->anime = 'teste';
        $analises->episodio = 1;
        $analises->id_user = 5;
        $analises->id_categoria = 2;
        $analises->created_at = $currentDateTime;

        $analises->image = 'e83a5786340bb1640c7e7a44b5676b99.png';
        $analises->save();

        }
        */

    }
}
