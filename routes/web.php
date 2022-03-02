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

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', function () { return view('auth.login'); });
    Route::get('verify', function () { return view('auth.verify'); });  
    Route::get('activate/{code}', 'UserController@activate');
    Route::post('complete/{id}', 'UserController@complete');  
});

Route::group([
    'middleware' => 'verified',
], function () {
    Route::get('profile', function () { return view('auth.profile'); })->name('profile');
    Route::get('password', function () { return view('auth.passwords.update'); })->name('password');
    Route::post('updateAccount', 'UserController@updateAccount');
    Route::post('changePassword', 'Auth\ChangePasswordController@store');
    Route::resource('enrollments', 'EnrollmentController');
});

Route::group([
    'middleware' => 'isnt_admin',
], function () {
    Route::get('home', 'HomeController@home')->name('home');
});

Route::group([
    'middleware' => 'is_admin',
    'prefix' => 'admin'
], function () {
    Route::get('home', 'HomeController@adminHome')->name('home');
    Route::get('enrollments.report', 'EnrollmentController@report')->name('enrollments.report');
    Route::get('enrollments.generate', 'EnrollmentController@generate')->name('enrollments.generate');
    Route::resource('users', 'UserController');
    Route::resource('courses', 'CourseController');
    Route::resource('students', 'StudentController');
    Route::resource('teachers', 'TeacherController');
    Route::resource('sections', 'SectionController');
    Route::resource('processes', 'ProcessController');
});