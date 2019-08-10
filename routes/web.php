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

		//All listings
		Route::get('/listings', 'Frontend\IndexController@listings');

		// Login Check
		Route::post('/login_check', 'Frontend\IndexController@login_check');

		// user logout
		Route::get('/logout_frontend', 'Frontend\IndexController@logout_frontend');

		// Register View
		Route::get('/register', 'Frontend\IndexController@register');

		// register post request
		Route::post('/register_check', 'Frontend\IndexController@register_check');

		//forgot Password
		Route::get('/forgot_password', 'Frontend\IndexController@forgot_password');
		Route::post('/forgot_send_email', 'Frontend\IndexController@forgot_send_email');
		Route::get('/enter_new_password/{GUID}', 'Frontend\IndexController@enter_new_password');
		Route::post('/forgot_reset_password', 'Frontend\IndexController@forgot_reset_password');

		//profile update page
		Route::get('/profile', 'Frontend\IndexController@profile');

		// Coach Profile view Page
		Route::get('/coach_profile/{user_id}', 'Frontend\IndexController@coach_profile');

		//profile update request
		Route::post('/update_my_data', 'Frontend\IndexController@update_my_data');

		//Product Listings
		Route::get('/products/{type}', 'Frontend\IndexController@products');

		//Tools Product
		Route::get('/tools', 'Frontend\IndexController@tools');

		// BOoks Product
		Route::get('/books', 'Frontend\IndexController@books');

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
		Route::get('/schools/{school_id}/{subscriptions_id}/view/', 'Frontend\IndexController@school_detail');

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

		// My all purchases
		Route::get('/all_purchases', 'Frontend\IndexController@my_purchases');

		// My all subscriptions
		Route::get('/all_subscriptions', 'Frontend\IndexController@my_subscriptions');

		// Apply to be a coach form
		Route::get('/be_a_coach', 'Frontend\IndexController@be_a_coach');

		// be a coach request submit
		Route::post('/be_a_coach_submit', 'Frontend\IndexController@be_a_coach_submit');

		// Training Activities
		Route::get('/training_activities', 'Frontend\IndexController@training_activities');

		// Training Activities Detail Page
		Route::get('/{subscription_id}/activity_detail', 'Frontend\IndexController@activity_detail');

		// View Communication Contact Us
		Route::get('/communication', 'Frontend\IndexController@communication');

		// Contact Us post request from communication page
		Route::post('/communication_contact_us_email', 'Frontend\IndexController@communication_contact_us_email');

		// Email Subscribe by visitor or user
		Route::post('/email_subscribe_user', 'Frontend\IndexController@email_subscribe_user');

		// Email Subscribe by visitor or user
		Route::post('/updatevideowatched', 'Frontend\IndexController@updatevideowatched');

		// comment on Video
		Route::post('/submit_comment', 'Frontend\IndexController@submit_comment');

		// video starts from
		Route::post('/videoStartsFrom', 'Frontend\IndexController@videoStartsFrom');

		// Add/Update Video Time
		Route::post('/InsertVideoTime', 'Frontend\IndexController@InsertVideoTime');

		// Delete Video Time
		Route::post('/deleteVideoTime', 'Frontend\IndexController@deleteVideoTime');

		// chapter test
		Route::get('/chapters/{chapter_id}/test/serve', 'Frontend\IndexController@chapter_test');

		// chapter test attempt by user (Answers)
		Route::post('/test_answer', 'Frontend\IndexController@test_answer');

		// All Given test results by user
		Route::get('/all_tests', 'Frontend\IndexController@all_tests');

		// All Events
		Route::get('/events', 'Frontend\IndexController@events');

		// Event Detail
		Route::get('/events/{id}', 'Frontend\IndexController@eventDetail');

		// Enroll in Course form page
		Route::get('{course_id}/enroll_course', 'Frontend\IndexController@enroll_course');

		// Enroll in Course form page submit
		Route::post('/enroll_form', 'Frontend\IndexController@enroll_form');

		// payment of course enroll
		Route::get('/{coursed_id}/payment_course/{subscriptions_id}', 'Frontend\IndexController@payment_course');

		// input coupen check Ajax
		Route::post('/coupenCheck', 'Frontend\IndexController@coupenCheck');

		// Payment of course 
		Route::post('/enroll_course_payment', 'Frontend\IndexController@enroll_course_payment');

		// Change language of backend
		Route::post('/changLangAdminPanel', 'Frontend\IndexController@changLangAdminPanel');

		// dropdown select change ajax
		Route::post('/dropdownFieldSelect', 'Frontend\IndexController@dropdownFieldSelect');

		// Admin route (Get Notifications)
		Route::post('/getnotifications', 'Frontend\IndexController@getNotifications');

		// Admin route (Read Notification)
		Route::post('/read_notification', 'Frontend\IndexController@read_notification');

		// view comments in backend
		Route::get('/admin/{comment_id}/comments_reply', 'Voyager\VoyagerCommentsController@comments_reply_backend');

		// Reply of comment
		Route::get('/admin/comments/{comment_id}/reply', 'Voyager\VoyagerCommentsController@reply');

		// Users enrolled in school
		Route::get('/admin/schools/{school_id}/students', 'Voyager\VoyagerSchoolController@enrolledStudents');

		// User overall performance
		Route::get('/admin/schools/{school_id}/student/overall/{student_id}', 'Voyager\VoyagerSchoolController@overallStudent');

		// Exam records
		Route::get('/admin/exams/{exam_id}/records', 'Voyager\VoyagerExamController@records');

		
	});

});


Route::group(['prefix' => '/'.Request::segment(1).'/admin'], function () {
	Voyager::routes();
});



