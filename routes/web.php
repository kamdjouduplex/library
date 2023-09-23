<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

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

Route::get('/books',  [BooksController::class, 'index'])->name('list_book');
Route::post('/books', [BooksController::class, 'store'])->name('add_book');
Route::patch('/books/{book}', [BooksController::class, 'update'])->name('update_book');
Route::delete('/books/{book}', [BooksController::class, 'destroy'])->name('delete_book');

Route::post('/author', [AuthorController::class, 'store'])->name('add_author');