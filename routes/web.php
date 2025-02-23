<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentsController;




Route::get('/login', function () {
    return view('login'); // Render the login page (login.blade.php)
})->name('login'); // Add the name 'login' here


Route::get('/register', function () {
    return view('register'); // Points to the register.blade.php view
});

Route::post('/register', [UserController::class, 'register']);   //connected to web.php register
Route::post('/logout', [UserController::class, 'logout']);   //connected to web.php logout
Route::post('/login', [UserController::class, 'login']);   //connected to web.php login



// Protected Routes (Authenticated Users Only)
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home');
    });
    // Students Routes
    Route::get('/students', [StudentsController::class, 'index'])->name('students.index');  // Protected
    Route::get('/students/search', [StudentsController::class, 'search'])->name('students.search');  // Protected

    
    // Student Edit Routes
    Route::get('/students/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit');  // Protected
    Route::put('/students/{id}', [StudentsController::class, 'update'])->name('students.update');  // Protected

    // Student Delete Routes
    Route::delete('/students/{id}', [StudentsController::class, 'destroy'])->name('students.destroy');  // Protected

    // Add new student (protected)
    Route::post('/add-new', [StudentsController::class, 'addNewStudent'])->name('std.addNewStudent');  // Protected
    // NOte: please take out this from }); to view with out auth Public Students View Route (If needed to be public)
    Route::get('/', [StudentsController::class, 'myView'])->name('std.myView'); // Public if required

});

// if you want to view public
// Route::get('/', [StudentsController::class, 'myView'])->name('std.myView'); // Public if required


// Example: Public view for home page (no authentication needed)
//Route::get('/home', function () {
  //  return view('home');
//});