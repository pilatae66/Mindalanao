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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('user.index');

Route::delete('/user/{user}', 'UserController@delete')->name('user.delete');

Route::get('/positions', 'PositionController@index')->name('position.index');

Route::get('/position/create', 'PositionController@create')->name('position.create');

Route::post('/position', 'PositionController@store')->name('position.store');

Route::get('/position/{position}/edit', 'PositionController@edit')->name('position.edit');

Route::patch('/position/{position}', 'PositionController@update')->name('position.update');

Route::delete('/position/{position}', 'PositionController@destroy')->name('position.destroy');

Route::get('/getUserData', 'UserController@getAllUsers')->name('user.all');

Route::get('/getPositionsData', 'PositionController@getAllPosition')->name('position.all');
