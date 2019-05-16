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
// Route::get('/', function () {
//     return view('welcome');
// });

// login user
Route::get('/userlogin', 'Frontend\IndexController@login');
// Login Check
Route::post('/login_check', 'Frontend\IndexController@login_check');
// user logout
Route::get('/logout_frontend', 'Frontend\IndexController@logout_frontend');

//forgot Password
Route::get('/forgot_password', 'Frontend\IndexController@forgot_password');
Route::post('/forgot_send_email', 'Frontend\IndexController@forgot_send_email');
//View About Page
Route::get('/about', 'Frontend\IndexController@about');
//profile update page
Route::get('/profile', 'Frontend\IndexController@profile');
//profile update request
Route::post('/update_my_data', 'Frontend\IndexController@update_my_data');
//profile update page
Route::get('/products', 'Frontend\IndexController@products');

// Route::get('/', 'Frontend\IndexController@login');
Route::get('/{lang?}', 'Frontend\IndexController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
