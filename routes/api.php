<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    NoticiaCategoriaController,
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
Route::get('/noticias', [NoticiaCategoriaController::class, 'index']);

//AUTH
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/sanctum/token', [AuthClientController::class, 'auth']);

Route::group(['middleware' => ['auth:sanctum', 'OptionalAuthSanctum']], function () {
    Route::get('/auth/me', [AuthClientController::class, 'me']);
});
