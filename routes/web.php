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

Auth::routes(['reset' => false]);
Route::view('/', 'home')->name("home");
Route::resource('suggestions', 'SuggestionController')->only('store');
Route::resource('app', 'AppController');
Route::resource('list', 'ListController');
Route::resource('task', 'TaskController');
Route::resource('user', 'UserController');
Route::post('user/{id}', 'UserController@updatePassword')->name('user.updatePassword');
