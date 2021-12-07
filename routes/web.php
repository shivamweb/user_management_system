<?php

use Illuminate\Support\Facades\Auth;
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
    return view('test');
});

Route::get('new-record', function () {
    return view('new-record');
});

//load login display
Route::get('login', function () {
    return view('login');
})->name('login')->middleware('is_login');

//to call the user_login function
Route::post('/checklogin', 'App\Http\Controllers\RecordsController@checklogin');

//Route::get('records', 'App\Http\Controllers\RecordsController@index')->middleware(['auth', 'is_verify_email']); 
Route::get('account/verify/{token}', 'App\Http\Controllers\RecordsController@verifyAccount')->name('user.verify');

//resource to direct access the  class
Route::resource('recordsController', 'App\Http\Controllers\RecordsController');

//to fetch the image from table and decode it 
Route::get('store_image/fetch_image/{id}', 'App\Http\Controllers\RecordsController@fetch_image');

Route::get('admin-login', function () {
    return view('admin-login');
})->name('admin-login')->middleware('is_adminlogin');

Route::post('admin-login', 'App\Http\Controllers\AdminController@loginCheck');

// to call the function which send mail for password reset
Route::post('forgot-Password', 'App\Http\Controllers\ForgotPasswordController@forgotPasswordMail');

Route::get('forgotPassword', function () {
    return view('forgotPassword');
});

/*
|--------------------------------------------------------------------------
| Group Routes => Check_access_level 
|--------------------------------------------------------------------------
| It check the routes allow the user to access , 
| if user has done login. Other wise it will move to login page.
|
*/
Route::group(['middleware' => ['Check_access_level']], function () {

    //update the recourds based on id passed in parameter
    Route::put('/update-record/{id}', 'App\Http\Controllers\RecordsController@update');

    //load all records 
    Route::get('records', 'App\Http\Controllers\RecordsController@index');

    //logout the user
    Route::get('/logout', 'App\Http\Controllers\RecordsController@logout')->name('logout');

    //this route get the token from user email and show password reset form
    Route::get('reset-password/{token}', 'App\Http\Controllers\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');

    //submit the new password, when user forget password
    Route::post('submitResetPasswordForm', 'App\Http\Controllers\ForgotPasswordController@submitResetPasswordForm');


    Route::get('change-password', function () {
        return view('changePassword');
    });

    Route::post('change-password', 'App\Http\Controllers\ForgotPasswordController@changePassword');
});

Route::group(['middleware' => ['Admin_access_level']], function () {

    //load admin dashboard
    Route::get('admin-dashboard', 'App\Http\Controllers\AdminController@index');

    //delete records based on id passed in parameter
    Route::get('/delete-record/{id?}', 'App\Http\Controllers\AdminController@destroy')->name('delete');

    //logout the user
    Route::get('admin-logout', 'App\Http\Controllers\AdminController@logout')->name('admin-logout');

    //show the user registration history in graph in report display
    Route::get('report', 'App\Http\Controllers\ReportsController@show_reports');

    //show the user registration history in graph in report display
   //Route::get('user-login-report', 'App\Http\Controllers\ReportsController@user_login_report');
    Route::get('user-login-report', function () {
        return view('user-login-report');
    });
});
