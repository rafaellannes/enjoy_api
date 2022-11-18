<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    NoticiaController,
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


//NOTICIAS
Route::get('/noticias', [NoticiaController::class, 'index']);

//AUTH
Route::post('/register', [RegisterController::class, 'register']); //Registrar
Route::post('/sanctum/token', [AuthClientController::class, 'auth']); //Login

Route::group(['middleware' => ['auth:sanctum', 'OptionalAuthSanctum']], function () { //Rotas protegidas
    Route::get('/auth/me', [AuthClientController::class, 'me']);
});
