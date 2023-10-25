<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    ClientController,
    CupomController,
    FavoritoController,
    HistoricoController,
    NoticiaCategoriaController,
    NoticiaController,
    PesquisaController,
    PrefeituraController,
    RoteiroController,
    RoteiroLikeController,
    ServicoCategoriaController,
    ServicoController,
    SubcategoriaController,
};

use App\Http\Controllers\Api\Auth\{
    RegisterController,
    AuthClientController,
    ForgotPasswordController
};


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
Route::get('/servicos/group/subcategoria', [ServicoController::class, 'getServicosGroupBySubcategoria']);
//

//PESQUISA
Route::get('/pesquisa/{filter}', [PesquisaController::class, 'search']);
//


//AUTH
Route::post('/register', [RegisterController::class, 'register']); //Registrar
Route::post('/login', [AuthClientController::class, 'auth']); //Login
//

//RESET PASSWORD
Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);
//


Route::group(['middleware' => ['auth:sanctum']], function () { //Rotas protegidas

    Route::get('/servico/{uuid}/acesso', [ServicoController::class, 'acessoServico']);


    //CLIENT LOGADO - TOKEN
    Route::get('/auth/me', [AuthClientController::class, 'me']);
    Route::post('client/update', [ClientController::class, 'update']); //Atualizar dados do cliente
    Route::post('client/remove', [ClientController::class, 'remove']); //Remover cliente
    //

    //HISTORICO
    Route::resource('clients/historicos', HistoricoController::class)->only(['index', 'store', 'destroy']);
    //

    //FAVORITOS
    Route::resource('clients/favoritos', FavoritoController::class)->only(['index', 'store', 'destroy']);
    //

    //CUPONS

    //CUPONS DO SERVICO DISPONIVEIS PARA O CLIENTE
    Route::get('/servicos/{uuid}/cupons', [CupomController::class, 'cuponsDisponiveisByServico']);

    //RESGATAR CUPOM
    Route::post('/clients/cupons/{uuid}/resgatar', [CupomController::class, 'resgatarCupom']);

    //CUPONS DO CLIENTE
    Route::get('/clients/cupons', [CupomController::class, 'cuponsByClient']);
    //

    //ROTEIROS LIKE
    Route::resource('/clients/roteiros/likes', RoteiroLikeController::class)->only(['index', 'store']);
    Route::delete('/clients/roteiros/deslike', [RoteiroLikeController::class, 'deslike']);
    //

    //ROTEIROS
    Route::resource('clients/roteiros', RoteiroController::class);
    Route::post('clients/roteiros/servicos/attach', [RoteiroController::class, 'attachRoteiroServico']);
    Route::post('clients/roteiros/servicos/dettach', [RoteiroController::class, 'dettachRoteiroServico']);

    Route::get('clients/roteiros/{uuidRoteiro}/servicos', [RoteiroController::class, 'servicosAvailable']); //Servicos disponiveis para o roteiro
    Route::get('clients/roteiros/{uuidServico}/roteiros', [RoteiroController::class, 'roteirosAvailable']); //Roteiros disponiveis para o servico
    //

    //ROTEIROS PUBLICOS
    Route::get('/roteiros/publicos', [RoteiroController::class, 'roteirosPublicos']); //Roteiros publicos que não pertencem ao cliente logado e que não estão na lista de likes do cliente logado
    //


    //Route::post('/logout', [AuthClientController::class, 'logout']);

});
