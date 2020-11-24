<?php

use App\Http\Controllers\counselorsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [counselorsController::class, 'index'])->name('dashboard');

Route::get('/user', [counselorsController::class, 'index']);
Route::get('/show/{student_id}', [counselorsController::class, 'show'])->name('show');
Route::get('/info/{student_id}', [counselorsController::class, 'info'])->name('info');
