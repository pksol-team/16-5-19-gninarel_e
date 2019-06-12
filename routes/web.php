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

MultiLang::routeGroup(function($router) {

	Route::middleware(['direction'])->group(function(){

		//  home Page
		Route::get('/', 'Frontend\IndexController@index');
		// login user
		Route::get('/userlogin', 'Frontend\IndexController@login');

		// Login Check
		Route::post('/login_check', 'Frontend\IndexController@login_check');

		// user logout
		Route::get('/logout_frontend', 'Frontend\IndexController@logout_frontend');

		// Register
		Route::get('/register', 'Frontend\IndexController@register');

		// register post request
		Route::post('/register_check', 'Frontend\IndexController@register_check');

		//forgot Password
		Route::get('/forgot_password', 'Frontend\IndexController@forgot_password');
		Route::post('/forgot_send_email', 'Frontend\IndexController@forgot_send_email');

		//profile update page
		Route::get('/profile', 'Frontend\IndexController@profile');

		//profile update request
		Route::post('/update_my_data', 'Frontend\IndexController@update_my_data');

		//Product Listings
		Route::get('/products/{type}', 'Frontend\IndexController@products');

		//Product Detail Page
		Route::get('/product/{product_id}/view', 'Frontend\IndexController@product_detail');

		// Buy Product
		Route::get('/product/{product_native_id}/checkout', 'Frontend\IndexController@buy_product');

		//checkout Post request
		Route::post('/checkout_post', 'Frontend\IndexController@checkout_post');

		// Thank You Page
		Route::get('/thank_you', 'Frontend\IndexController@thank_you');
		
		//View About Page
		Route::get('/about', 'Frontend\IndexController@about');

		//View About Page
		Route::get('/plans_pricing', 'Frontend\IndexController@plans_pricing');

		//View Contact Us Page
		Route::get('/contact_us', 'Frontend\IndexController@contact_us');

		// Contact Us post request
		Route::post('/contact_us_email', 'Frontend\IndexController@contact_us_email');

		//View Contact Us Page
		Route::get('/terms_and_conditions', 'Frontend\IndexController@terms');

		//View Contact Us Page
		Route::get('/refund_policy', 'Frontend\IndexController@refund_policy');

		//View Disclaimers Page
		Route::get('/disclaimers', 'Frontend\IndexController@disclaimers');

		//View Partners Page
		Route::get('/our_partners', 'Frontend\IndexController@our_partners');

		//View podcasts Page
		Route::get('/podcasts', 'Frontend\IndexController@podcasts');

		//View Media Page
		Route::get('/media', 'Frontend\IndexController@media');

		// View Schools of users
		Route::get('/schools', 'Frontend\IndexController@schools');

		//View courses Page 
		Route::get('/schools/{school_id}/view', 'Frontend\IndexController@school_detail');

		//Course Detail Page
		Route::get('/chapters/{chapter_id}/view', 'Frontend\IndexController@chapter_detail');

		//Watch Video Page
		Route::get('/courses/{course_id}/video/{video_id}', 'Frontend\IndexController@watch_video');
		
		//All Schools 
		Route::get('/allschools', 'Frontend\IndexController@allschools');

		//View school detail page
		Route::get('/school/{school_id}/view', 'Frontend\IndexController@school_view');

		//All Approved Coaches
		Route::get('/coaches', 'Frontend\IndexController@coaches');

		//Buy Plan for School
		Route::post('/buy_plan', 'Frontend\IndexController@buy_plan');

		//Buy Plan for School Final
		Route::post('/buy_plan_school', 'Frontend\IndexController@buy_plan_school');

		
		



	});

});


Route::group(['prefix' => '/'.Request::segment(1).'/admin'], function () {
	Voyager::routes();
});



