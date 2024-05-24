<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('welcome');
});
Route::post('/', function () {
    return view('welcome');
});
Route::post('/upload', [FileController::class, 'upload'])->name('upload');

