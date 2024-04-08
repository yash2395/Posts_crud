<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});

Route::get('/index',[PostController::class,'index'])->name('post.index');
Route::get('/create',[PostController::class,'create'])->name('post.create');
Route::post('/store',[PostController::class,'store'])->name('post.store');
Route::get('/edit/{post}',[PostController::class,'edit'])->name('post.edit');
Route::post('/update/{post}',[PostController::class,'update'])->name('post.update');
Route::get('/filterByDate', [PostController::class,'filterByDate'])->name('filterByDate');



