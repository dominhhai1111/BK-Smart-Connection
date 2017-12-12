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

Route::get('/admin/showActivityWords', "AdminController@showActivityWords")->name("showActivityWords");

Route::get('/admin/deleteActivityWord/{id}', "AdminController@deleteActivityWord")->name("deleteActivityWord");

Route::post('/admin/addActivityWord', "AdminController@addActivityWord")->name("addActivityWord");

Route::get('/admin/showActivity', "AdminController@showActivity")->name("showActivity");

Route::get('/admin/deleteActivity/{id}', "AdminController@deleteActivity")->name("deleteActivity");

Route::post('/admin/addActivity', "AdminController@addActivity")->name("addActivity");

Route::get('/admin/showGenre', "AdminController@showGenre")->name("showGenre");

Route::get('/admin/deleteGenre/{id}', "AdminController@deleteGenre")->name("deleteGenre");

Route::post('/admin/addGenre', "AdminController@addGenre")->name("addGenre");

Route::get('/admin/showGenreWords', "AdminController@showGenreWords")->name("showGenreWords");

Route::get('/admin/deleteGenreWord/{id}', "AdminController@deleteGenreWord")->name("deleteGenreWord");

Route::post('/admin/addActivityWord', "AdminController@addActivityWord")->name("addActivityWord");

Route::get('/admin/showFeelingWords', "AdminController@showFeelingWords")->name("showFeelingWords");

Route::get('/admin/deleteFeelingWord/{id}', "AdminController@deleteFeelingWord")->name("deleteFeelingWord");

Route::post('/admin/addFeelingWord', "AdminController@addFeelingWord")->name("addFeelingWord");

Route::get('/admin/showFeeling', "AdminController@showFeeling")->name("showFeeling");

Route::get('/admin/deleteFeeling/{id}', "AdminController@deleteFeeling")->name("deleteFeeling");

Route::post('/admin/addFeeling', "AdminController@addFeeling")->name("addFeeling");

Route::get('/getMusicUrlForUser/{score}/{objects}', "BKSmartConnection@getMusicUrlForUser")->name("getMusicUrlForUser");

Route::get('/playMusic/{music}', "BKSmartConnection@playMusic")->name("playMusic");

Route::get('/getResponse/request={request}', "ChatBotController@getResponse")->name("getResponse");