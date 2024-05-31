<?php
namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeamsMenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamController;
// Маршрут для отображения формы аутентификации
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Маршрут для аутентификации пользователя
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Маршрут для выхода пользователя из приложения
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/menu/{employee_id}', [TeamsMenuController::class, 'index'])->name('menu');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/teams/{id}/download/{filename}', [TeamController::class, 'download'])->name('teams.download');
Route::post('/teams/{id}/upload', [TeamController::class, 'upload'])->name('teams.upload');
Route::delete('/teams/{id}/delete/{filename}', [TeamController::class, 'deleteFile'])->name('teams.deleteFile');

Route::get('/', function () {
    return view('welcome');
});
Route::post('/', function () {
    return view('welcome');
});
Route::post('/upload', [FileController::class, 'upload'])->name('upload');

