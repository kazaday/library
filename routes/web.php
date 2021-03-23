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

Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');
Route::prefix('book')->group(function(){
    Route::get('/show/{id}', [App\Http\Controllers\BookController::class, 'show'])->name('book.show');
    Route::get('/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');
    Route::get('/new/', [App\Http\Controllers\BookController::class, 'create'])->name('book.create');
    Route::post('/', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');
    Route::post('/{id}', [App\Http\Controllers\BookController::class, 'update'])->name('book.update');
    Route::delete('/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('book.destroy');
});
Route::prefix('authors')->group(function(){
    Route::get('/', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors');
    Route::get('/{id}', [App\Http\Controllers\AuthorController::class, 'edit'])->name('author.edit');
    Route::get('/new/', [App\Http\Controllers\AuthorController::class, 'create'])->name('author.create');
    Route::post('/', [App\Http\Controllers\AuthorController::class, 'store'])->name('author.store');
    Route::post('/{id}', [App\Http\Controllers\AuthorController::class, 'update'])->name('author.update');
    Route::delete('/{id}', [App\Http\Controllers\AuthorController::class, 'destroy'])->name('author.destroy');
});

