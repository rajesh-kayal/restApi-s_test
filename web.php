<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TodoController;

Route::get('/todos',[TodoController::class, 'getAll']);
Route::get('/todo/{id}', [TodoController::class, 'TodoId']);
Route::post('/todo/add/', [TodoController::class, 'insert']);
Route::any('/todo/edit/{id}', [TodoController::class, 'edit']);
Route::delete('/todo/delete/{id}', [TodoController::class, 'delete']);
