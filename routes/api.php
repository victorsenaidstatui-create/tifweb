<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

Route::post('/alunos', [AlunoController::class, 'store']);
Route::post('/registros', [RegistroController::class, 'store']);
