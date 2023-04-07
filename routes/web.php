<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;

//Cadastro, Login, Recuperação de Senha, Dashboard, Alterar Senha

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'logar'])->name('logar');

Route::get('/cadastrar', [UsuarioController::class, 'view_cadastro'])->name('cadastro-page');
Route::post('/cadastrar', [UsuarioController::class, 'cadastrar'])->name('cadastrar');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::get('/alterar_senha', [PasswordController::class, 'alterar_senha'])->name('alterar_senha');
Route::put('/alterar_senha', [PasswordController::class, 'changePassword'])->name('change_password');

Route::get('/recuperar_senha', [PasswordController::class, 'recuperar_senha'])->name('recuperar_senha');
Route::post('/recuperar_senha', [PasswordController::class, 'recoverPassword'])->name('recover_password');




