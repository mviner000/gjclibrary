<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']); //php artisan install:api
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('addnew', [UserController::class, 'store']);
Route::put('usersupdate/{id}', [UserController::class, 'update']);
Route::delete('usersdelete/{id}', [UserController::class, 'destroy']);

Route::get('books', [BookController::class, 'index']); 
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('addnewbook', [BookController::class, 'store']);
Route::put('booksupdate/{id}', [BookController::class, 'update']);
Route::delete('booksdelete/{id}', [BookController::class, 'destroy']);