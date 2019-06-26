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
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', 'UserController@index')->name('user.index');

        Route::get('/all', 'UserController@getAllUsersAPI')->name('user.allEmployees');

        Route::get('/create', 'UserController@create')->name('user.create');

        Route::post('/', 'UserController@store')->name('user.store');

        Route::delete('/{user}', 'UserController@delete')->name('user.delete');

        Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');

        Route::patch('/{user}', 'UserController@update')->name('user.update');

        Route::get('/getUserData', 'UserController@getAllUsers')->name('user.all');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'UserController@index')->name('admin.index');

        Route::get('/all', 'UserController@getAllAdminAPI')->name('admin.all');

        Route::get('/create', 'UserController@create')->name('admin.create');

        Route::post('/', 'UserController@store')->name('admin.store');

        Route::delete('/{user}', 'UserController@delete')->name('admin.delete');

        Route::get('/{user}/edit', 'UserController@editAdmin')->name('admin.edit');

        Route::patch('/{user}', 'UserController@updateAdmin')->name('admin.update');

        Route::get('/getAdminData', 'UserController@getAllAdmins')->name('admin.all');
    });
});


Route::resource('/position', 'PositionController');

Route::group(['prefix' => 'positions'], function () {

    Route::get('/getMembers/{position}', 'UserController@getMembers')->name('position.getMembers');

    Route::get('/getPositionsData', 'PositionController@getAllPosition')->name('position.all');
});

Route::resource('/department', 'DepartmentController');

Route::get('/getDepartmentData', 'DepartmentController@getAllDepartment')->name('department.all');

Route::resource('/activity', 'ActivityController');

Route::group(['prefix' => 'activities'], function () {
    Route::get('/showAll', 'ActivityController@showAll')->name('activity.showAll');
});

Route::get('/getActivityData', 'ActivityController@getAllActivity')->name('activity.all');

Route::get('/activity/{activity}/getAttendees', 'ActivityController@getAllAttendees')->name('activity.attendees');

Route::delete('/removeAttendee/{attendees}/{activity}', 'ActivityController@removeAttendee')->name('activity.removeAttendee');

Route::get('/getAllEmployee/{activity}', 'ActivityController@getAllEmployees')->name('activity.getAllEmployees');

Route::post('/addEmployeeToActivity', 'ActivityController@addEmployeeToActivity')->name('activity.addEmployeeToActivity');

Route::resource('/deduction', 'DeductionController');

Route::group(['prefix' => 'deductions'], function () {
    Route::get('/all', 'DeductionController@getAllDeduction')->name('deduction.all');
});

Route::resource('/benefit', 'BenefitController');

Route::group(['prefix' => 'benefits'], function () {
    Route::get('/all', 'BenefitController@getAllBenefits')->name('benefit.all');
    Route::get('/showAll', 'BenefitController@showAllBenefits')->name('benefit.showAll');
});

Route::resource('/leave', 'LeaveController');

Route::group(['prefix' => 'leaves'], function () {
    Route::get('/all', 'LeaveController@getAllLeaves')->name('leave.all');
    Route::get('/showAll', 'LeaveController@showAll')->name('leave.showAll');
});

Route::resource('/leaveType', 'LeaveTypeController');

Route::group(['prefix' => 'types'], function () {
    Route::get('/all', 'LeaveTypeController@getAllTypes')->name('types.all');
});

Route::resource('/compensation', 'CompensationController');

Route::group(['prefix' => 'compensations'], function () {
    Route::get('/all', 'CompensationController@getAll')->name('compensation.all');
});

Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

Route::group(['prefix' => 'payslip'], function () {
    Route::get('/{id}', 'PayslipController@employeeShow')->name('payslip.employee');
});

