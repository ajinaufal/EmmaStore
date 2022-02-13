<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\coba;
use App\Http\Controllers\ProfileController;
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
Route::get('/', 'App\Http\Controllers\IndexController@index')->name('home');

Route::get('/aboutus', 'App\Http\Controllers\AboutusController@index');

Route::get('/tc', 'App\Http\Controllers\TcController@index');

Route::get('/privasi', 'App\Http\Controllers\PrivasiController@index');

Route::get('/faqs', 'App\Http\Controllers\FaqsController@index');

Route::get('/detail/{id}', 'App\Http\Controllers\ProductController@detail');

Route::get('/quickview/{id}', 'App\Http\Controllers\ProductController@quickview');

Route::get('/etalase/{name}/{page}', 'App\Http\Controllers\ProductController@etalase');

Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('/dologin', 'App\Http\Controllers\AuthController@dologin'); 

Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/doregister', 'App\Http\Controllers\AuthController@doregister'); 
Route::get('/registersuccess', 'App\Http\Controllers\AuthController@registersuccess')->name('registersuccess');

Route::get('/forgotpassword', 'App\Http\Controllers\AuthController@forgotpassword')->name('forgotpassword');
Route::post('/doforgotpassword', 'App\Http\Controllers\AuthController@doforgotpassword'); 

// Route::get('/readcart',  'App\Http\Controllers\CartController@read');

Route::get('/readcart', [CartController::class, 'read']);

Route::get('/cobaemail', [CheckoutController::class, 'coba']);
// Route::post('/updatecart', [CartController::class, 'update']);

Route::get('/getcity/{keyword}', 'App\Http\Controllers\CityController@getcity')->name('getcity');

Route::group(['middleware' => 'auth'], function () {
    Route::post('cart_home', [CartController::class, 'HomeCart']);
    Route::post('/item',  [CartController::class, 'get_item']);
    Route::post('/update_variant', [CartController::class, 'update_variant']);
    Route::get('/get_data', [CartController::class, 'get_data']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::get('/profile', [ProfileController::class, 'index']);
    // Route::post('data_kota', [CartController::class, 'data_kota']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
 
});