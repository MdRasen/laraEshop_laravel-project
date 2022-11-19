<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\customerController;
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

Route::get('/', [publicController::class,'index'])->name('index');

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

    //Coupon
    Route::get('/add-coupon', [adminController::class,'addCoupon'])->name('admin.add-coupon');
    Route::post('/add-coupon', [adminController::class,'addCouponSubmit'])->name('admin.add-coupon');
    Route::get('/view-coupon', [adminController::class,'viewCoupon'])->name('admin.view-coupon');
    Route::get('/edit-coupon/{coupon_id}', [adminController::class,'editCoupon'])->name('admin.edit-coupon');
    Route::post('/edit-coupon/{coupon_id}', [adminController::class,'editCouponSubmit'])->name('admin.edit-coupon');
    Route::post('/delete-coupon', [adminController::class,'deleteCoupon'])->name('admin.delete-coupon');
    Route::post('/assign-coupon', [adminController::class,'assignCoupon'])->name('admin.assign-coupon');

    //Order
    Route::get('/view-order', [adminController::class,'viewOrder'])->name('admin.view-order');
    Route::get('/view-order-details/{order_number}', [adminController::class,'viewOrderDetails'])->name('admin.view-order-details');
});

//Vendor Routes
Route::prefix('vendor')->group(function (){

});

//Customer Routes
Route::prefix('customer')->middleware('isCustomer')->group(function (){
    Route::get('/dashboard', [customerController::class,'dashboard'])->name('customer.dashboard');
    Route::get('/view-cart', [customerController::class,'viewCart'])->name('customer.view-cart');
    Route::get('/add-cart/{product_id}', [customerController::class,'addCart'])->name('customer.add-cart');
    Route::post('/add-cart-quantity', [customerController::class,'addCartQuantity'])->name('customer.add-cart-quantity');
    Route::get('/cart-increment/{cartitem_id}', [customerController::class,'cartIncrement'])->name('customer.cart-increment');
    Route::get('/cart-decrement/{cartitem_id}', [customerController::class,'cartDecrement'])->name('customer.cart-decrement');
    Route::post('/cart-remove-item', [customerController::class,'cartItemRemove'])->name('customer.cart-remove-item');
    Route::get('/view-checkout', [customerController::class,'viewCheckout'])->name('customer.view-checkout');
    Route::post('/view-checkout', [customerController::class,'viewCheckoutSubmit'])->name('customer.view-checkout');
    Route::get('/view-coupons', [customerController::class,'viewCoupon'])->name('customer.view-coupon');
    Route::get('/view-orders', [customerController::class,'viewOrder'])->name('customer.view-order');
    Route::get('/view-order-details/{order_number}', [customerController::class,'viewOrderDetails'])->name('customer.view-order-details');
});

//Public Routes
Route::prefix('public')->group(function (){
    Route::get('/registration', [publicController::class,'registration'])->name('public.registration');
    Route::post('/registration', [publicController::class,'registrationSubmit'])->name('public.registration');
    Route::get('/login', [publicController::class,'login'])->name('public.login');
    Route::post('/login', [publicController::class,'loginSubmit'])->name('public.login');
    Route::get('/logout', [publicController::class,'logout'])->name('public.logout');
    Route::get('/category/{category_slug}', [publicController::class,'categoryProducts'])->name('public.category-products');
    Route::get('/{category_slug}/{product_slug}', [publicController::class,'viewProduct'])->name('public.view-product');
});
