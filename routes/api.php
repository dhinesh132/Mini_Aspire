<?php

use Illuminate\Http\Request;

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

Route::post('user/login', 'API\UserController@login');
Route::post('user/create', 'API\UserController@create');
Route::post('loan/create', 'API\LoanController@create');
Route::post('loan/payment', 'API\LoanController@payment');
