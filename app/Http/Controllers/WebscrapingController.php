<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\OpenAIRequest;
use DOMDocument;
use DOMXPath;
use Goutte\Client;
use App\Helpers\filter;
use Orhanerday\OpenAi\OpenAi;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\Noticia;

class WebscrapingController extends Controller
{
    public function noticiacomChatGPT(){

        //$currentDateTime = Carbon::now();

        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $site = 'https://www.animenewsnetwork.com/news/';

        $client = new Client();

        $crawler = $client->request('GET', $site);

        //$imagens = $crawler->filter('div.herald.box.news div.thumbnail')->each(function ($node) {
        //    return $node->attr('data-src');
        //});

        //dd($imagens);

        $crawler->filter('div.herald.box.news')->each(function ($container) use ($currentDateTime) {
            $lul = 1;
            if($lul == 1){

            $timeTags = $container->filter('time')->attr('datetime');

            $timeTagsCarbon = Carbon::parse($timeTags);

            if ($timeTagsCarbon->isSameDay($currentDateTime)) {

                //dd('PASSO');

                $imagens = $container->filter('div.herald.box.news div.thumbnail')->each(function ($node) {
                    return $node->attr('data-src');
                });

                $imagens = 'https://www.animenewsnetwork.com'.$imagens[0];

                //dd($imagens);

                $aTags = $container->filter('a')->eq(1)->attr('href');

                $aTags ='https://www.animenewsnetwork.com'.$aTags;

                $client2 = new Client();

                $crawler2 = $client2->request('GET', $aTags);

                //dd($crawler2);

                //$imagens = $crawler2->filter('div.news figure img')->each(function ($node) {
                //   return $node->attr('src');
                //});

                //dd($imagens);

                $title = $crawler2->filter('meta[name="title"]')->attr('content');

                $texto = $crawler2->filter('div.meat')->html();

                //dd($texto);

                //

                $title = "Gerar um titulo em portugues com no maximo 250 caracteres com base nesse titulo: '{$title}'. \n e com base nesse texto '{$texto}'";

                $texto = "Gerar uma noticia em portugues com base nesse texto: '{$texto}'";

                $tag = "Gerar uma unica tag com base nesse titulo: '{$title}'.\n a tag deve ser baseada no assunto da noticia";

                //dd($texto);

                //

                $api = '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';
                $open_ai = new OpenAi($api);

                $link = $aTags;

                //$title = $openAI->completion()->model('text-davinci-002')->prompt($title)->generate();

                $title = $open_ai->completion([
                'prompt' => $title,
                'temperature' => 0.7,
                'max_tokens' => 280,
                'n' => 1,
                'stop' => ['\n'],
                'frequency_penalty' => 0,
                'presence_penalty' => 0
                ]);

                
                //$texto = $openAI->completion()->model('text-davinci-002')->prompt($texto)->generate();

                // Dividindo o texto em partes com no máximo 2.048 max_tokens
                $parts = str_split($texto, 2048);

                // Variável que irá armazenar o texto completo
                $full_text = '';

                // Iterando sobre as partes e fazendo a requisição para cada uma delas
                foreach ($parts as $part) {
                    $result = $open_ai->completion([
                        'prompt' => $part,
                        'temperature' => 0.7,
                        'max_tokens' => 2048,
                        'n' => 1,
                        'stop' => ['\n'],
                        'frequency_penalty' => 0,
                        'presence_penalty' => 0
                    ]);

                    // Adicionando o resultado à variável que armazena o texto completo
                    $full_text .= json_decode($result)->choices[0]->text;
                }
                
                //$tag = $openAI->completion()->model('text-davinci-002')->prompt($tag)->generate();

                $tag = $open_ai->completion([
                'prompt' => $tag,
                'temperature' => 0.7,
                'max_tokens' => 500,
                'n' => 1,
                'stop' => ['\n'],
                'frequency_penalty' => 0,
                'presence_penalty' => 0
                ]);

                $noticias = new Noticia;
                $noticias->titulo = json_decode($title)->choices[0]->text;
                $noticias->descricao = $full_text;
                $noticias->tags = json_decode($tag)->choices[0]->text;
                $noticias->id_user = 5;
                $noticias->id_categoria = 1;
                $noticias->created_at = Carbon::now('America/Sao_Paulo');

                $client = new GuzzleClient();

                $response = $client->get($imagens);
                $extension = pathinfo($imagens, PATHINFO_EXTENSION);
                $imageName = md5(basename($imagens) . strtotime('now')) . '.' . $extension;

                $destinationPath = public_path('img/noticias');
                $fullImagePath = $destinationPath . '/' . $imageName;

                file_put_contents($fullImagePath, $response->getBody());

                $noticias->image = $imageName;

                $noticias->save();

                dd('noticia salva');

            }

            }

        });

    }
}
