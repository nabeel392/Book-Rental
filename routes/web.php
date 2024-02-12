<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Routes for user authentication

Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// Routes for user registration
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

});


// Routes for home page

Route::middleware('auth')->group(function () {
Route::get('/home', [HomeController::class, 'showhomepage'])->name('home');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/rent/{book}', [BookController::class, 'rent'])->name('books.rent');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


});
