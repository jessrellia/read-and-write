<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::group(['middleware' => 'is_admin'], function () {
    // View update page (form)
    Route::get('/product-update/{product:id}', 'MainController@viewUpdate');
    // Update product
    Route::post('/product-update/{request:id}', 'MainController@updateProduct');
    // Delete product
    Route::post('/delete', 'MainController@deleteProduct');
    // View add product page (form)
    Route::get('/add-product', 'MainController@viewAddProduct'); 
    // Upload product
    Route::post('/add-product', 'MainController@addProduct');
    // View update product type (form)
    Route::get('/update-delete-product-type', 'MainController@viewUpdateProductType');
    // Update product type
    Route::post('/update-delete-product-type', 'MainController@updateDeleteProductType');
    // View add stationary type
    Route::get('/add-product-type', 'MainController@viewAddProductType');
    // Update stationary type
    Route::post('/add-product-type', 'MainController@addStationaryType');
});

Route::group(['middleware'=> 'is_member'],function(){
    //Add-To-Cart
    Route::post('/add-to-Cart','MainController@addToCart');
    //View Cart
    Route::get('/view-cart','MainController@viewCart');
    //View Update cart page(form)
    Route::get('/update-cart/{product:id}','MainController@updateCartForm');
    //update Cart
    Route::post('/update-cart','MainController@updateCart');
    //delete-cart
    Route::post('/delete-cart/{product:id}','MainController@deleteCart');
    //checkout
    Route::get('/checkout','MainController@checkout');
    //view-transaction-history
    Route::get('/view-transaction-history','MainController@viewtransactionhistory');
});


// Main homepage, show 4 most bought category
Route::get('/','MainController@hpStationaryTypes');
// Login, register
Route::get('/home', 'HomeController@index')->name('home');
// Search product based on category from homepage
Route::get('/products/{types:name?}','MainController@findProduct');
// Search product based on name (search bar)
Route::get('/product/search', 'MainController@searchProduct');
// View product details 
Route::get('/details/{product:id}', 'MainController@viewProductDetails')->middleware('registered_user');
// Show must login page, then redirect to homepage
Route::get('/mustlogin', 'MainController@mustLogin');

