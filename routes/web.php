<?php

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

Route::get('/', "BKSmartConnection@index")->name("top-page");

Route::get('/admin', "AdminController@index")->name("admin-page");

Route::get('/admin/showCustomers', "AdminController@showCustomers")->name("show-customers");

Route::get('/user_id={user_id}', "BKSmartConnection@show")->name("getUser");
