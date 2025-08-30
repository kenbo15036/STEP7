<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');
Route::get('/new', [App\Http\Controllers\ProductController::class, 'registProduct'])->name('new');
Route::post('/new', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('registSubmit');
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'productDetail'])->name('detail');
Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('delete');
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('edit');
Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('update');