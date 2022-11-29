<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    ClientController,
    FavoritoController,
    HistoricoController,
    NoticiaCategoriaController,
    NoticiaController,
    PesquisaController,
    PrefeituraController,
    ServicoCategoriaController,
    ServicoController,
    SubcategoriaController,
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

//SUBCATEGORIAS-SERVICOS
Route::get('/subcategorias/categoria/{UuidCategoria}', [SubcategoriaController::class, 'subcategoriasByCategoria']);
//

//SERVICOS
Route::get('/servicos', [ServicoController::class, 'index']);
Route::get('/servico/{uuid}', [ServicoController::class, 'show']);
Route::get('/servicos/subcategoria/{uuid}', [ServicoController::class, 'getServicosBySubcategoria']);
Route::get('/servicos/categoria/{uuid}', [ServicoController::class, 'getServicosByCategoria']);

Route::get('/servicos/group/categoria', [ServicoController::class, 'getServicosGroupByCategoria']);
//

//PESQUISA
Route::get('/pesquisa/{filter}', [PesquisaController::class, 'search']);
//


//AUTH
Route::post('/register', [RegisterController::class, 'register']); //Registrar
Route::post('/login', [AuthClientController::class, 'auth']); //Login
//

Route::group(['middleware' => ['auth:sanctum']], function () { //Rotas protegidas

    //CLIENT LOGADO - TOKEN
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::put('client/update', [ClientController::class, 'update']); //Atualizar dados do cliente
    //

    //HISTORICO
    Route::resource('clients/historicos', HistoricoController::class)->only(['index', 'store', 'destroy']);
    Route::resource('clients/favoritos', FavoritoController::class)->only(['index', 'store', 'destroy']);


    //Route::post('/logout', [AuthClientController::class, 'logout']);

});
