<?php

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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['namespace' => 'API'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::post('store', 'UserController@store');
        Route::put('update/{id}', 'UserController@update')->where('id', '[0-9]+');
        Route::delete('delete/{id}', 'UserController@destroy')->where('id', '[0-9]+');
        Route::get('all', 'UserController@getUsersList');
    });
    Route::group(['prefix' => 'tasks'], function () {
        Route::post('store', 'TaskController@store');
        Route::put('update/{id}', 'TaskController@update')->where('id', '[0-9]+');
        Route::put('update/status/{id}', 'TaskController@updateStatusTask')->where('id', '[0-9]+');
        Route::put('update/user/{id}', 'TaskController@updateUsersTask')->where('id', '[0-9]+');
        Route::delete('delete/{id}', 'TaskController@destroy')->where('id', '[0-9]+');
        Route::get('all', 'TaskController@getTaskList');
    });
});
