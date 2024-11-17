<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome'); /* Rota Inicial */

Route::get('/home', [HomeController::class, 'index'])->name('home'); /* Rota após login */
/* Rotas de cadastro */
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register.index');
    Route::post('/register', 'store')->name('register.store');
});

/* Rotas de Login */
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});

/* Rotas de Tarefas */
Route::resource('/tasks', TaskController::class);

/* Rota para mudar a situação da tarefa */
Route::get('tasks/change-situation-task/{task}', [TaskController::class, 'changeSituation'])->name('task.change-situation');

// Rota de Tarefas com Filtro por Categoria
Route::get('/tasks/category/{category?}', [TaskController::class, 'index'])->name('tasks.index.category');

/* Rotas de Categorias */
Route::resource('/categories', CategoryController::class);