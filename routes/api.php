<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('update',  [CartController::class, 'update']);
Route::post('dalete',  [CartController::class, 'delet']);

Route::get('search', [CartController::class, 'search']);

Route::post('add_item', [CartController::class, 'store']);

