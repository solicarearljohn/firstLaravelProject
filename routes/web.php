<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentsController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login'); // Render the login page (login.blade.php)
});


Route::get('/register', function () {
    return view('register'); // Points to the register.blade.php view
});

Route::post('/register', [UserController::class, 'register']);   //connected to web.php register
Route::post('/logout', [UserController::class, 'logout']);   //connected to web.php logout
Route::post('/login', [UserController::class, 'login']);   //connected to web.php login

//this is on homepage
// View
Route::get('/', [StudentsController::class, 'myView'])->name('std.myView');
// Create
Route::post('/add-new', [StudentsController::class, 'addNewStudent'])->name('std.addNewStudent');
Route::get('/items', [ItemController::class, 'index']);
