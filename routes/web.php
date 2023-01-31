<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\ContasController;
use App\Http\Controllers\MovimentacoesController;

// Route::get('/pessoas' , [PessoasController::class, 'index']);
// Route::get('/pessoas/criar' , [PessoasController::class, 'create']);
// Route::post('/pessoas/salvar' , [PessoasController::class, 'store']);
// Route::delete('/pessoas/excluir/{id}' , [PessoasController::class, 'destroy'])->name('pessoas.excluir');
// Route::get('/pessoas/edit/{pessoa}' , [PessoasController::class, 'edit'])->name('pessoas.edit');
// Route::put('/pessoas/alterar/{pessoa}' , [PessoasController::class, 'update'])->name('pessoas.alterar');
Route::resource('/pessoas', PessoasController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
Route::resource('/contas', ContasController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
Route::resource('/movimentacoes', MovimentacoesController::class)->only(['index', 'create', 'store']);
