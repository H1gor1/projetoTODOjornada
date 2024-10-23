<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'paginaPrincipal']);

Route::post('/inserir', [TaskController::class, 'store']);

Route::put('/concluir/{id}', [TaskController::class, 'concluir']);

Route::put('/desconcluir/{id}', [TaskController::class, 'desconcluir']);

Route::delete('/deletar/{id}', [TaskController::class, 'deletar']);

Route::put('restaurar/{id}', [TaskController::class, 'restaurar']);

Route::delete('destruir/{id}', [TaskController::class, 'destruir']);

Route::put('/atualizar/{id}', [TaskController::class, 'atualizar']);