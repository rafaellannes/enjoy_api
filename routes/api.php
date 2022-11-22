<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    NoticiaCategoriaController,
    NoticiaController,
    PrefeituraController,
    ServicoCategoriaController,
    ServicoController,
};

use App\Http\Controllers\Api\Auth\{
    RegisterController,
    AuthClientController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//PREFEITURAS
Route::get('/prefeituras', [PrefeituraController::class, 'index']);
//

//CATEGORIA-NOTICIA
Route::get('/categorias-noticias', [NoticiaCategoriaController::class, 'index']);
//

//NOTICIAS
Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticia/{uuid}', [NoticiaController::class, 'show']);
Route::get('/noticias/categoria/{UuidCategoria}', [NoticiaController::class, 'noticiasByCategoria']);
//

//CATEGORIAS-SERVICOS
Route::get('/categorias', [ServicoCategoriaController::class, 'index']);
//

//SERVICOS
Route::get('/servicos', [ServicoController::class, 'index']);
Route::get('/servico/{uuid}', [ServicoController::class, 'show']);
//


//AUTH
Route::post('/register', [RegisterController::class, 'register']); //Registrar
Route::post('/login', [AuthClientController::class, 'auth']); //Login
//

Route::group(['middleware' => ['auth:sanctum']], function () { //Rotas protegidas
    Route::get('/auth/me', [AuthClientController::class, 'me']);
});
