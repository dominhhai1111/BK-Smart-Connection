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

Route::get('/admin/showAllUsers', "AdminController@showAllUsers")->name("showAllUsers");

Route::get('/getUsers/user_id={user_id}', "BKSmartConnection@show")->name("getUser");

Route::get('/admin/showAllCircumstances', "AdminController@showAllCircumstances")->name("showAllCircumstances");

Route::get('/admin/showAllSolutions', "AdminController@showAllSolutions")->name("showAllSolutions");

Route::get('/getSolutionForUser/{score}/{objects}', "BKSmartConnection@getSolutionForUser")->name("getSolutionForUser");

Route::get('/getMusic/{music}', "BKSmartConnection@getMusic")->name("getMusic");




