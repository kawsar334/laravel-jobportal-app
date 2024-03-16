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





Route::group(['account'],function(){
    // middlewar if user is not authenticated redirect to these route . 
Route::group(['middleware'=> 'guest'],function(){
        Route::get('/account/register', [AccountController::class, 'Registration'])->name('account.register');
        Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
        Route::post("account/registerprocess", [AccountController::class, 'create'])->name('account.registerprocess');
        Route::post('/account/auth', [AccountController::class, 'authentication'])->name('account.auth'); 
});


// middlewar if user is authenticated redirect to thes route
Route::group(['middleware'=>'auth'],function(){
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
        Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('account/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::post('account/update',[AccountController::class, 'updateprofile'])->name('account.update');
        Route::post('/account/updatepic',[AccountController::class, 'updateprofilePicture'])->name('account.updateimg');
        Route::get('/account/job',[AccountController::class,'createJob'])->name('account.job');
        Route::post('/account/savejob',[AccountController::class, 'savejob'])->name('account.savejob');
        Route::get('/account/myJobs',[AccountController::class, 'myJobs'])->name('account.myJobs');
});
});


