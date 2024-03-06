<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/account/register',[AccountController::class, 'Registration'])->name('account.register');
Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
Route::post("account/registerprocess",[AccountController::class, 'create'])->name('account.registerprocess');
Route::post('/account/auth',[AccountController::class,'authentication'])->name('account.auth');


