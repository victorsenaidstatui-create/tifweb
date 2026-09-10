<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::view('/welcome', 'welcome');
Route::get('/cadastro_aluno', [AlunoController::class, 'cadastro_aluno_html'])->name('cadastro.aluno');
Route::redirect('/cadastro_usuario', '/cadastro_aluno');
Route::get('/registrar_entrada', [RegistroController::class, 'registrar_entrada_html'])->name('registrar.entrada');
Route::get('/historico', [RegistroController::class, 'historico'])->name('historico');