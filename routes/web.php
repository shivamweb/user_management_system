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

//this route get the token from user email and show password reset form
Route::get('reset-password/{token}', 'App\Http\Controllers\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');


//submit the new password, when user forget password
Route::post('submitResetPasswordForm', 'App\Http\Controllers\ForgotPasswordController@submitResetPasswordForm');


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

    Route::get('change-password', function () {
        return view('changePassword');
    });

    Route::post('change-password', 'App\Http\Controllers\ForgotPasswordController@changePassword');

    // create new post
    Route::get('new-post', 'App\Http\Controllers\RecordsController@newPost');
    
    // show all post
    //Route::get('post', 'App\Http\Controllers\RecordsController@showPost');

    Route::get('post', function () {
        return view('post');
    });

    Route::get('comments/{id}', 'App\Http\Controllers\RecordsController@showComments');
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
    Route::get('user-login-report', 'App\Http\Controllers\ReportsController@select_user');
    
    Route::get('user-login-history/{id?}', 'App\Http\Controllers\ReportsController@user_login_history');
});

Route::get('relation', 'App\Http\Controllers\ReportsController@relation');

Route::get('create-product', 'App\Http\Controllers\ProductController@createProduct');

Route::get('belongsToMany', 'App\Http\Controllers\ProductController@manyToMany');

Route::get('test', 'App\Http\Controllers\HomeController@test');

Route::get('/delete-post/{id?}', 'App\Http\Controllers\RecordsController@deletepost')->name('post-delete');

Route::get('/deleted-post', 'App\Http\Controllers\RecordsController@deletedPost')->name('deletedPost');

Route::get('/restore-post/{id?}', 'App\Http\Controllers\RecordsController@restorepost')->name('post-restore');

Route::get('master', function () {
    return view('master');
});

// social media login through google 
Route::get('auth/google', 'App\Http\Controllers\GoogleSocialiteController@redirectToGoogle');
Route::get('callback/google', 'App\Http\Controllers\GoogleSocialiteController@handleCallback');

// social media login through github 
Route::get('auth/github', 'App\Http\Controllers\GithubSocialiteController@redirectToProvider');
Route::get('auth/github/callback', 'App\Http\Controllers\GithubSocialiteController@handleProviderCallback');

// social media login through facebook 
Route::get('auth/facebook', 'App\Http\Controllers\FacebookSocialiteController@redirectToProvider');
Route::get('auth/facebook/callback', 'App\Http\Controllers\FacebookSocialiteController@handleProviderCallback');

// social media login through twitter 
Route::get('auth/twitter', 'App\Http\Controllers\TwitterSocialiteController@redirectToProvider');
Route::get('auth/twitter/callback', 'App\Http\Controllers\TwitterSocialiteController@handleProviderCallback');