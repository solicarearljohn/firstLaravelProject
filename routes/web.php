<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StudentsController;

// View
Route::get('/', [StudentsController::class, 'myView'])->name('std.myView');
// Create
Route::post('/add-new', [StudentsController::class, 'addNewStudent'])->name('std.addNewStudent');

Route::get('/items', [ItemController::class, 'index']);