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
Route::get('/', function (){
    return view("welcome");
});
Route::get('/ruletest1', "BKSmartConnection@ruletest1")->name("ruletest1");
Route::get('/test/{object1}/{object2}', "BKSmartConnection@test")->name("test");
Route::get('/admin', "AdminController@index")->name("admin-page");
Route::get('/admin/showAllUsers', "AdminController@showAllUsers")->name("showAllUsers");
Route::get('/getUsers/user_id={user_id}', "BKSmartConnection@show")->name("getUser");
Route::get('/admin/showAllCircumstances', "AdminController@showAllCircumstances")->name("showAllCircumstances");
Route::get('/admin/showAllSolutions', "AdminController@showAllSolutions")->name("showAllSolutions");

Route::get('/admin/showGenre', "AdminController@showGenre")->name("showGenre");
Route::get('/admin/deleteGenre/{id}', "AdminController@deleteGenre")->name("deleteGenre");
Route::post('/admin/addGenre', "AdminController@addGenre")->name("addGenre");

Route::get('/admin/showView', "AdminController@showView")->name("showView");
Route::get('/admin/deleteView/{id}', "AdminController@deleteView")->name("deleteView");
Route::post('/admin/addView', "AdminController@addView")->name("addView");

Route::get('/admin/showFeelingWords', "AdminController@showFeelingWords")->name("showFeelingWords");
Route::get('/admin/deleteFeelingWord/{id}', "AdminController@deleteFeelingWord")->name("deleteFeelingWord");
Route::post('/admin/addFeelingWord', "AdminController@addFeelingWord")->name("addFeelingWord");

Route::get('/admin/showFeeling', "AdminController@showFeeling")->name("showFeeling");
Route::get('/admin/deleteFeeling/{id}', "AdminController@deleteFeeling")->name("deleteFeeling");
Route::post('/admin/addFeeling', "AdminController@addFeeling")->name("addFeeling");

Route::get('/admin/showSongs', "AdminController@showSongs")->name("showSongs");
Route::get('/admin/deleteSong/{id}', "AdminController@deleteSong")->name("deleteSong");
Route::post('/admin/addSong', "AdminController@addSong")->name("addSong");

Route::get('/admin/showSingers', "AdminController@showSingers")->name("showSingers");
Route::get('/admin/deleteSinger/{id}', "AdminController@deleteSinger")->name("deleteSinger");
Route::post('/admin/addSinger', "AdminController@addSinger")->name("addSinger");

Route::get('/admin/showAlbumView/{id}', "AdminController@showAlbumView")->name("showAlbumView");
Route::get('/admin/deleteSongInAlbumView/{song_id}/{view_id}', "AdminController@deleteSongInAlbumView")->name("deleteSongInAlbumView");
Route::get('/admin/addSongToAlbumView/{song_id}/{view_id}', "AdminController@addSongToAlbumView")->name("addSongToAlbumView");

Route::get('/admin/showAlbumGenre/{id}', "AdminController@showAlbumGenre")->name("showAlbumGenre");
Route::get('/admin/deleteSongInAlbumGenre/{song_id}/{Genre_id}', "AdminController@deleteSongInAlbumGenre")->name("deleteSongInAlbumGenre");
Route::get('/admin/addSongToAlbumGenre/{song_id}/{Genre_id}', "AdminController@addSongToAlbumGenre")->name("addSongToAlbumGenre");

Route::get('/admin/showAlbumFeeling/{id}', "AdminController@showAlbumFeeling")->name("showAlbumFeeling");
Route::get('/admin/deleteSongInAlbumFeeling/{song_id}/{feeling_id}', "AdminController@deleteSongInAlbumFeeling")->name("deleteSongInAlbumFeeling");
Route::get('/admin/addSongToAlbumFeeling/{song_id}/{feeling_id}', "AdminController@addSongToAlbumFeeling")->name("addSongToAlbumFeeling");

Route::get('/getMusicUrlForUser/{score}/{objects}', "BKSmartConnection@getMusicUrlForUser")->name("getMusicUrlForUser");
Route::get('/playMusic/{music}', "BKSmartConnection@playMusic")->name("playMusic");
Route::get('/getResponse/request={request}', "ChatBotController@getResponse")->name("getResponse");
Route::get('/rule4/{music}', "BKSmartConnection@rule4")->name("rule4");
Route::get('/rule1/{music}', "BKSmartConnection@rule1")->name("rule1");
Route::get('/setDataTest', "BKSmartConnection@setDataTest")->name("setDataTest");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
