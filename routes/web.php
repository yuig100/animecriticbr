<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\AnalisesController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\AnimesController;
use App\Http\Controllers\GuiadeTemporadaController;
use App\Http\Controllers\PesquisarController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebscrapingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Rota de Teste*/
Route::get('/test', [WebscrapingController::class, 'noticiacomChatGPT']);
Route::get('/test2', [TestController::class, 'test'])->name('teste');

/*Home*/
Route::get('/', [HomeController::class, 'index']);

/*Contato*/
Route::get('/contato', [ContatoController::class, 'contato']);

/*Noticias*/
Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias');
Route::get('/noticias/create', [NoticiasController::class, 'create'])->middleware('auth');
Route::post('/noticias', [NoticiasController::class, 'store'])->middleware('auth');

Route::get('/noticias/{ano}/{mes}/{dia}/{link}', [NoticiasController::class, 'show']);

Route::get('/noticias/edit/{ano}/{mes}/{dia}/{link}',[NoticiasController::class, 'edit'])->middleware('auth');
Route::put('/noticias/update/{ano}/{mes}/{dia}/{link}',[NoticiasController::class,'update'])->middleware('auth');

Route::get('/noticias/delete/{ano}/{mes}/{dia}/{link}', [NoticiasController::class, 'destroy'])->middleware('auth');

/*Analises*/
Route::get('/analises', [AnalisesController::class, 'index']);
Route::get('/analises/create', [AnalisesController::class, 'create'])->middleware('auth');
Route::post('/analises', [AnalisesController::class, 'store'])->middleware('auth');
Route::get('/analises/{anime}/{episodio}', [AnalisesController::class, 'show']);

Route::get('/analises/delete/{anime}/{episodio}', [AnalisesController::class, 'destroy'])->middleware('auth');
Route::get('/analises/edit/{anime}/{episodio}',[AnalisesController::class, 'edit'])->middleware('auth');
Route::put('/analises/update/{anime}/{episodio}',[AnalisesController::class,'update'])->middleware('auth');

/*Guia de Temporada*/
Route::get('/guia-de-temporada', [GuiadeTemporadaController::class, 'index']);
Route::get('/guia-de-temporada/{ano}/{estacao}/{link}', [GuiadeTemporadaController::class, 'show']);

Route::get('/guia-de-temporada/create', [GuiadeTemporadaController::class, 'create'])->middleware('auth');
Route::post('/guia-de-temporada', [GuiadeTemporadaController::class, 'store'])->middleware('auth');

Route::get('/guia-de-temporada/edit/{ano}/{estacao}/{link}',[GuiadeTemporadaController::class, 'edit'])->middleware('auth');
Route::put('/guia-de-temporada/update/{ano}/{estacao}/{link}',[GuiadeTemporadaController::class,'update'])->middleware('auth');

Route::get('/guia-de-temporada/delete/{ano}/{estacao}/{link}', [GuiadeTemporadaController::class, 'destroy'])->middleware('auth');

/*Animes*/

Route::get('/animes', [AnimesController::class, 'index']);

Route::get('/animes/create', [AnimesController::class, 'create'])->middleware('auth');
Route::post('/animes', [AnimesController::class, 'store'])->middleware('auth');
Route::get('/animes/{anime}', [AnimesController::class, 'show']);
Route::get('/animes/edit/{anime}', [AnimesController::class, 'edit'])->middleware('auth');
Route::put('/animes/update/{anime}', [AnimesController::class, 'update'])->middleware('auth');

Route::get('/animes/delete/{anime}', [AnimesController::class, 'destroy'])->middleware('auth');

/*Calendario*/

Route::get('/calendario/create', [CalendarioController::class, 'create'])->middleware('auth');
Route::post('/calendario', [CalendarioController::class, 'store'])->middleware('auth');

Route::get('/calendario/edit/{id}', [CalendarioController::class, 'edit'])->middleware('auth');
Route::put('/calendario/update/{id}', [CalendarioController::class, 'update'])->middleware('auth');

Route::get('/calendario/delete/{id}', [CalendarioController::class, 'destroy'])->middleware('auth');

Route::get('/calendario/show/{anime}', [CalendarioController::class, 'show'])->middleware('auth');

Route::get('/calendario', [CalendarioController::class, 'calendario']);
Route::get('/calendario/{ano}/{estacao}', [CalendarioController::class, 'index']);

/*Procurar*/
Route::get('/search', [PesquisarController::class, 'pesquisar'])->name('search');
Route::get('/searchcat', [PesquisarController::class, 'pesquisarCategoria']);
Route::get('/searchtag', [PesquisarController::class, 'pesquisarTags']);

Route::get('/searchanim', [PesquisarController::class, 'pesquisarAnimes'])->name('anime-search');

/*Login e Registro*/

Route::get('/register', [UsersController::class, 'create'])->name('register');
Route::post('/register', [UsersController::class, 'store']);

Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'storelogin']);

Route::get('/profile',[UsersController::class,'index'])->name('profile');
Route::get('/profile/{nickname}',[UsersController::class,'show']);

Route::get('/profile/edit/{nickname}', [UsersController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/profile/edit', [UsersController::class, 'update'])->middleware('auth');

Route::get('/logout', [UsersController::class, 'logout'])->name('logout')->middleware('auth');

/*Editar usuarios*/



/*Categoria*/
Route::get('/categoria', [CategoriaController::class, 'index'])->middleware('auth');

Route::get('/categoria/create', [CategoriaController::class, 'create'])->middleware('auth');
Route::post('/categoria', [CategoriaController::class, 'store'])->middleware('auth');

Route::get('/categoria/edit/{id}', [CategoriaController::class, 'edit'])->middleware('auth');
Route::post('/categoria/edit/{id}', [CategoriaController::class, 'update'])->middleware('auth');

Route::get('/categoria/delete/{id}', [CategoriaController::class, 'destroy'])->middleware('auth');


/*Comentarios*/
//Route::post('/comentarios', [ComentariosController::class, 'store'])->name('comentarios.store');
//Route::post('/comentarios/{comentario}/upvote', [ComentariosController::class, 'upvote'])->name('comentarios.upvote');
//Route::post('/comentarios/{comentario}/downvote', [ComentariosController::class, 'downvote'])->name('comentarios.downvote');
//Route::post('/comentarios/{comentario}/toggle-visibility', [ComentariosController::class, 'toggleVisibility'])->name('comentarios.toggle-visibility');


/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
 */
