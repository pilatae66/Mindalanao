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

    Route::get('/', 'UserController@index')->name('user.index');

    Route::get('/create', 'UserController@create')->name('user.create');

    Route::post('/', 'UserController@store')->name('user.store');

    Route::delete('/{user}', 'UserController@delete')->name('user.delete');

});


Route::resource('/position', 'PositionController');

Route::resource('/department', 'DepartmentController');

Route::resource('/activity', 'ActivityController');

Route::get('/activity/{activity}/getAttendees', 'ActivityController@getAllAttendees')->name('activity.attendees');

Route::delete('/removeAttendee/{attendees}/{activity}', 'ActivityController@removeAttendee')->name('activity.removeAttendee');

Route::get('/getAllEmployee/{activity}', 'ActivityController@getAllEmployees')->name('activity.getAllEmployees');

Route::post('/addEmployeeToActivity', 'ActivityController@addEmployeeToActivity')->name('activity.addEmployeeToActivity');

Route::get('/getUserData', 'UserController@getAllUsers')->name('user.all');

Route::get('/getPositionsData', 'PositionController@getAllPosition')->name('position.all');

Route::get('/getDepartmentData', 'DepartmentController@getAllDepartment')->name('department.all');

Route::get('/getActivityData', 'ActivityController@getAllActivity')->name('activity.all');
