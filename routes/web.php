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


Route::group(['prefix' => 'users'], function () {

    Route::get('/users', 'UserController@index')->name('user.index');

    Route::delete('/{user}', 'UserController@delete')->name('user.delete');

});


Route::resource('/position', 'PositionController');

Route::resource('/department', 'DepartmentController');

Route::resource('/activity', 'ActivityController');

Route::get('/getUserData', 'UserController@getAllUsers')->name('user.all');

Route::get('/getPositionsData', 'PositionController@getAllPosition')->name('position.all');

Route::get('/getDepartmentData', 'DepartmentController@getAllDepartment')->name('department.all');

Route::get('/getActivityData', 'ActivityController@getAllActivity')->name('activity.all');
