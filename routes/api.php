<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ClienteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/carrinho/index/{id}', [CarrinhoController::class, 'indexApiCliente'])->name('api.carrinho.index');
Route::post('/carrinho/store', [CarrinhoController::class, 'storeApiCliente'])->name('api.carrinho.store');
Route::put('/carrinho/edit/{id}', [CarrinhoController::class, 'updateApiCliente'])->name('api.carrinho.update');
Route::delete('/carrinho/delete/{id}', [CarrinhoController::class, 'destroyApiCliente'])->name('api.carrinho.destroy');

Route::put('/cliente/edit/{id}', [ClienteController::class, 'updateApiCliente'])->name('api.cliente.update');
