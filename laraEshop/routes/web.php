<?php

use App\Http\Controllers\publicController;
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

Route::get('/', function () {
    return view('welcome');
});

//Admin Routes
Route::prefix('admin')->group(function (){

});

//Vendor Routes
Route::prefix('vendor')->group(function (){
    
});

//Customer Routes
Route::prefix('customer')->group(function (){
    
});

//Public Routes
Route::prefix('public')->group(function (){
    Route::get('/registration', [publicController::class,'registration'])->name('public.registration');
    Route::post('/registration', [publicController::class,'registrationSubmit'])->name('public.registration');
    Route::get('/login', [publicController::class,'login'])->name('public.login');
    Route::post('/login', [publicController::class,'loginSubmit'])->name('public.login');
});
