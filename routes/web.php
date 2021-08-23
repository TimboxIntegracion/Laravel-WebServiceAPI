<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimboxApiRest_Controller;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apikeytest',[TimboxApiRest_Controller::class, 'getApiKey']);
Route::get('/buscarAcuse', [TimboxApiRest_Controller::class, 'buscarAcuse']);
Route::get('/buscarCfdi', [TimboxApiRest_Controller::class, 'buscarCfdi']);
Route::get('/consultaLco', [TimboxApiRest_Controller::class, 'consultaLco']);
Route::get('/consultaRfc', [TimboxApiRest_Controller::class, 'consultaRfc']);
Route::get('/obtenerConsumo', [TimboxApiRest_Controller::class, 'obtenerConsumo']);
Route::get('/timbrarCfdi', [TimboxApiRest_Controller::class, 'timbrarCfdi']);
