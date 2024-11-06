<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/books/add', [BookController::class, 'create'])->name('books.add');

Route::resource('books', BookController::class);
Auth::routes();

Route::get('/home', function () {
    return redirect('/books');
});
Route::get('/', function () {
    return redirect('/books');
});
