<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

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



Route::resource('users', Usercontroller::class);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::get('/api/yash',function (){
  return 'this is yash controller';
});

//route with controller 
Route::post('/api/yash',[Usercontroller::class,'store']);

//resource controller 
Route::resource('permission',AuthController::class);

//route with parameter
Route::put('update/{id}',[AuthController::class ,'index'])->name('user.update');


// Route::middleware(['auth'])->group(
//     Route::get();
// );