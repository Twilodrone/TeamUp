<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::post('/upload', [FileController::class, 'upload']);
Route::get('/download', [FileController::class, 'download']);
Route::delete('/delete', [FileController::class, 'delete']);
Route::get('/list', [FileController::class, 'list']);


Route::get('/', function () {
    return view('welcome');
});
