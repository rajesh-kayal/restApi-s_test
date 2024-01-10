<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiControlle;
Route::get('/api/users',[ApiControlle::class, 'getAll']);
Route::post('/api/users/add', [ApiControlle::class, 'insert']);
Route::get('/api/users/{id}', [ApiControlle::class, 'getId']);
Route::any('/api/users/edit/{id}', [ApiControlle::class, 'edit']);
Route::delete('/api/users/delete/{id}', [ApiControlle::class, 'delete']); //also get method warking