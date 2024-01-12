<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/files', [FileController::class, 'getuser']);
// space
Route::post('/upload', [FileController::class, 'uploadFile']);

Route::post('/submit', [FileController::class, 'store']);

Route::get('/files/delete/{user}', [FileController::class, 'delete'])->name('file.delete');
