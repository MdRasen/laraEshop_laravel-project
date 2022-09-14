<?php

use App\Http\Controllers\adminController;
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

//Admin Routes
Route::prefix('admin')->middleware('isAdmin')->group(function (){
    Route::get('/dashboard', [adminController::class,'dashboard'])->name('admin.dashboard');

    //Categories
    Route::get('/add-category', [adminController::class,'addCategory'])->name('admin.add-category');
    Route::post('/add-category', [adminController::class,'addCategorySubmit'])->name('admin.add-category');
    Route::get('/view-category', [adminController::class,'viewCategory'])->name('admin.view-category');
    Route::get('/edit-category/{category_id}', [adminController::class,'editCategory'])->name('admin.edit-category');
    Route::post('/edit-category/{category_id}', [adminController::class,'editCategorySubmit'])->name('admin.edit-category');
    Route::post('/delete-category', [adminController::class,'deleteCategory'])->name('admin.delete-category');

    //Products
    Route::get('/add-product', [adminController::class,'addProduct'])->name('admin.add-product');
    Route::post('/add-product', [adminController::class,'addProductSubmit'])->name('admin.add-product');
    Route::get('/view-product', [adminController::class,'viewProduct'])->name('admin.view-product');
    Route::get('/edit-product/{product_id}', [adminController::class,'editProduct'])->name('admin.edit-product');
    Route::post('/edit-product/{product_id}', [adminController::class,'editProductSubmit'])->name('admin.edit-product');
    Route::post('/delete-product', [adminController::class,'deleteProduct'])->name('admin.delete-product');

    //Profile
    Route::get('/view-profile', [adminController::class,'viewProfile'])->name('admin.view-profile');
    Route::post('/update-profilepic', [adminController::class,'updateProfilePic'])->name('admin.update-profilepic');
    Route::get('/edit-profile', [adminController::class,'editProfile'])->name('admin.edit-profile');
    Route::post('/edit-profile', [adminController::class,'editProfileSubmit'])->name('admin.edit-profile');
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
    Route::get('/logout', [publicController::class,'logout'])->name('public.logout');
});
