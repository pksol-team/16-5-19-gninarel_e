<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use Session;
use Carbon\Carbon;
use Auth;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Validator;
use App\User;
use App\Product;
use App\ProductsNative;
use App\Order;
use App\Event;
use App\EventsNative;
use App\Category;
use App\CategoryNative;
use App\Course;
use App\CoursesNative;
use App\Chapter;
use App\ChaptersNative;
use App\Section;
use App\SectionNative;
use App\Video;
use App\VideoNative;
use App\School;
use App\SchoolsNative;
use App\VideoYoutube;
use App\UserSubscription;
use App\EmailSubscribe;
use App\AppliedCoach;
use App\User_access;
use App\Comment;
use App\VideoResume;
use App\Exams;
use App\TestQuestion;
use App\TestAnswer;
use App\UserAnswer;
use App\TestResult;
use App\UserLoginDetail;
use App\PromoCode;
use App\SchoolPlan;
use App\Notification;
use App\MediaImage;
use App\MediaDocument;
use Mail;
use Log;
use TCG\Voyager\Facades\Voyager;



class IndexController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public $langCode;

	public function __construct()
    {
        $this->langCode = Request::locale();
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	// View Home Page
	public function index()
	{
		$title = 'Home';
		return view('frontend.home', compact('title'));

	}

	// View Login Page
	public function login($lang = NULL)
	{
		$title = 'Login';
		if (Auth::check()) {
			return redirect(lang_url('/'));
		} else {
			return view('frontend.login', compact('title'));
		}
	}

	// check login Fields
	public function login_check(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$userGet = User::where('email', $email)->first();
		if ($userGet) {
			$passwordchecked = $userGet->password;
			if (Hash::check($password, $passwordchecked)) {
				if ($userGet->status == 'active') {
					Auth::attempt(['email' => $email, 'password' => $password]);
					
					$userAgent = $request->header('User-Agent');
					$loginUser = Auth::user();

					$userLoginDetail = UserLoginDetail::where([['email', $loginUser->email], ['user_agent', $userAgent]])->first();
					if (!$userLoginDetail) {
						$loginDetailCount = UserLoginDetail::where([['email', $loginUser->email]])->count();
						$status = 'saved';
						if ($loginDetailCount >= 2) {
							$status = 'new';
						}
						$insertLoginDetail = [
							'email' => $loginUser->email,
							'user_agent' => $userAgent,
							'status' => $status,
						    'created_at' => Carbon::now()
						];
						UserLoginDetail::insert($insertLoginDetail);
					}

					if (session()->has('url.intended')) {
						return redirect()->intended();
					} else {
						$request->session()->forget('url.intended');
						return redirect(lang_url(''));
					}
				} else {
					return redirect()->back()->withInput()->with('error', 'You account is locked for some reason! kindly contact Support team');
				}
			}
			else{
				return redirect()->back()->withInput()->with('error', 'User password does not match! If you do not have your account <a href="'. lang_url('register') .'">Register here </a>');
			}
		}else {
			return redirect()->back()->withInput()->with('error', 'This email address is not registered <a href="'. lang_url('register') .'">Register here </a>');
		}
	}

	//logout
	public function logout_frontend() {
		Auth::logout();
		session()->flush();
		return redirect(lang_url(''));
	}

	// View register Page
	public function register()
	{
		$title = 'Register';
		if (Auth::check()) {
			return redirect(lang_url('/'));
		} else {
			return view('frontend.register', compact('title'));
		}
	}

	// registration fields check and register
	public function register_check(Request $request)
	{
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$password = $request->input('password');

		$authenticateResult = $this->register_authenticate($email);
		if ($authenticateResult === true) {
		$hashKey = uniqid(time());
		$user = [
		    'name' => $name,
		    'role_id' => 3,
		    'email' => $email,
		    'phone' => $phone,
		    'password' => bcrypt($password),
		    'status' => 'active',
		    'settings' => '{"locale":"en"}',
		    'created_at' => Carbon::now()
		];
		$insertedUser = User::insert($user);
		$getInsertedId = DB::getPdo()->lastInsertId();
			$role = [
				'user_id' => $getInsertedId,
				'role_id' => 3,
			];
		DB::table('user_roles')->insert($role);

		$baseUrl = lang_url('');
		$msg_template = '
			<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
				<h3>Welcome to Better Trend<br></h3>
				<h4 style="padding: 0 20px 0 0;">
					<span style="font-size:11.0pt;line-height:107%;color:#3e4247">
						Thank You for Register
					</span>
				</h4>
				<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/verify_email/'.$getInsertedId.'/'.$password.'" style="color:#fff;">Confirm your email here</a>
				</button>
			</div>
		';
		$to = $email;
	    $subject = 'Account registration';
	    $content = $msg_template;

		$data = array( 'email' => $to, 'subject' => $subject, 'message' => $content);
		// Mail::send([], $data, function ($m) use($data) {
  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
  //   	});

		return redirect(lang_url('userlogin'))->with('message', 'Registration completed successfully kindly login');
		} else {
			return redirect()->back()->withInput()->with('error', $authenticateResult);
		}
	}

	// email address check if already check
	public function register_authenticate($email)
	{
        $haveUser = User::WHERE('email', $email)->first();
        if ($haveUser) {
    		return $messsage = 'This email address is already registered!';
        }
        else {
        	return true;
        }
	}

	// View About Page
	public function about()
	{
		$title = 'About';
		return view('frontend.about', compact('title'));
	}

	// View Forgot password Page
	public function forgot_password()
	{
		$title = 'Reset Password';
		if (Auth::check()) {
			return redirect(lang_url('userlogin'));
		} else {
			return view('frontend.reset', compact('title'));
		}
	}

	//forgot password Email Send to user
	public function forgot_send_email(Request $request)
	{
		$GUID = $this->getGUID();
		$email = $request->input('email');
		$userGet = User::where('email', $email)->first();
		if ($userGet) {
	    	$passwordKey = ['GUID' => $GUID];
	        $UserUpd = DB::table('users')->where('email', $email)->update($passwordKey);

        	$baseUrl = lang_url('/');
        	$msg_template = '
        		<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
				<h3>Bettertrend Password reset: </h3>
				<h4 style="padding: 0 20px 0 0;">Hello! <span style="color: #52a2f5;">'.$email.'</span>, Click on the link below to reset your password</h4><h4 style="padding: 0 20px 0 0;"> </h4>
				<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/enter_new_password/'.$GUID.'" style="color:#fff;">Reset your password</a></button>
				</div>';
            
            $content = $msg_template;
            $subject = 'Reset your password';

			$data = array( 'email' => $email, 'subject' => $subject, 'message' => $content);
			Mail::send([], $data, function ($m) use($data) {
	           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
	    	});
			return redirect()->back()->withInput()->with('message', 'Password Reset link send to your email kindly check your email');
		}else {
			return redirect()->back()->withInput()->with('error', 'This email address is not registered <a href="'. lang_url('register') .'">Register here </a>');
		}
		
	}

	// enter new password after forgot page
	public function enter_new_password($GUID)
	{

		$title = 'Reset your password';
		if (Auth::check()) {
			return redirect(lang_url('/'));
		} else {
			$userGet = User::where('GUID', $GUID)->first();
			if ($userGet != NULL) {
				return view('frontend.reset_password', compact('title', 'userGet'));
			} else {
				return redirect(lang_url('/'));
			}
		}
	}

	// update new password after forgot
	public function forgot_reset_password(Request $request)
	{
		if (Auth::check()) {
			return redirect(lang_url('/'));
		} else {
			$GUID = $request->input('GUID');
			$password = $request->input('password');
			$confirm_password = $request->input('confirm_password');
			if ($password == $confirm_password) {
		    	$Updatepassword = ['password' => bcrypt($confirm_password), 'GUID' => NULL];
		        $UserUpd = User::where('GUID', $GUID)->update($Updatepassword);
		        if ($UserUpd == TRUE) {
					return redirect(lang_url('userlogin'))->with('message', 'Password reset successfully');
		        } else {
					return redirect()->back()->withInput()->with('error', 'Oops! Something went wrong..');
		        }
			} else {
				return redirect()->back()->with('error', 'Your password and confirmation password do not match');	
			}
		}
	}

	//view Confirm email page
	public function confirm_email($hash_key)
	{
		$title = 'Confirm email';
		if (Auth::check()) {
			// return redirect(lang_url('/'));
			return view('frontend.confirm_email', compact('title'));
		} else {
			return view('frontend.confirm_email', compact('title'));

		}
	}

	// Verify Email through email
	public function verify_email($id, $hashkey)
	{
		$title = 'Verification email';
        $userFound = DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->first();
        if ($userFound) {

        	$confirm_email = [
        		'confirm_email' => NULL,
        		'status' => 'active',
        	];
        
        	DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->update($confirm_email);
        	$message = 'Thanks for verify your email. Please complete your profile';

        } else {
        	$message = 'Oops! Link expired or account already confirmed';
        }
		return view('frontend.thankyou_email', compact('title', 'message'));
	}

	// View all Tools
	public function tools()
	{
		$title = 'All Tools';

		$type = 'tool';

		$products = ProductsNative::with('productSpec')->whereHas('productSpec', function ($query) use ($type) {
			$query->where('type', $type);
		})->where([['lang', $this->langCode], ['status', 'active']])->get();
		$productsDecode = json_decode($products);

		return view('frontend.tools', compact('title', 'productsDecode', 'type'));
	}

	// View all Books
	public function books()
	{
		$title = 'All Books';

		$type = 'book';


		$products = ProductsNative::with('productSpec')->whereHas('productSpec', function ($query) use ($type) {
			$query->where('type', $type);
		})->where([['lang', $this->langCode], ['status', 'active']])->get();
		$productsDecode = json_decode($products);

		return view('frontend.books', compact('title', 'productsDecode', 'type'));
	}

	// View Product detail
	public function product_detail($product_id)
	{
    	$product = ProductsNative::with('productSpec')->where([['lang', $this->langCode], ['product_id', $product_id]])->first();

    	if (count($product) > 0) {
	    	
	    	$productDecode = json_decode($product);
			$title = $productDecode->name;
			return view('frontend.product_detail', compact('title', 'productDecode'));

    	} else {
			return redirect(lang_url('/'));
    	}
	}

	// Buy Product
	public function buy_product($product_native_id)
	{
    	$productNative = ProductsNative::with('productSpec')->where([['lang', $this->langCode], ['id', $product_native_id]])->first();
		if (Auth::check() && count($productNative) > 0) {

	    	if (count($productNative) > 0) {
		    	
		    	$productNativeDecode = json_decode($productNative);
				$title = $productNativeDecode->name;
				return view('frontend.buy_product', compact('title', 'productNativeDecode'));

	    	} else {
				return redirect('/');
	    	}
    	} else {
			Session::put('url.intended', lang_url('buy_product/'.$product_native_id.'/checkout'));
			return redirect(lang_url('userlogin'));
    	}
	}

	public function checkout_post(Request $request)
	{
		$user = Auth::user();
		$product_native_id = $request->input('product_native_id');
		$qty_input = $request->input('qty-input');
		$product_price = $request->input('product_price');
		$total_price = $request->input('total_price_hidden');
		$user_name = $request->input('first_name');
		$user_last_name = $request->input('last_name');
		$user_address = $request->input('user_address');
		if ($user) {
			$user_id = $user->id;
		} else {
			$user_id = NULL;
		}

		// Start Payment Process
		// 

		// 
		// End Payment Process

		$newOrder = [
			'product_native_id' => $product_native_id,
			'product_price' => $product_price,
			'total_price' => $total_price,
			'user_id' => $user_id,
			'user_name' => $user_name,
			'user_last_name' => $user_last_name,
			'user_address' => $user_address,
			'product_quantity' => $qty_input,
			'created_at' => Carbon::now(),
		];
		
		$orderInserted = Order::insert($newOrder);

		return redirect(lang_url('thank_you'));

	}

	// View Thank You Page
	public function thank_you()
	{
		$title = 'Thank You';
		return view('frontend.thankyou', compact('title'));
	}

	// View plans_pricing Page
	public function plans_pricing()
	{
		$title = 'Plans and Pricing';

		$allPlans = SchoolPlan::where('status', 'active')->get();

		return view('frontend.plans_pricing', compact('title', 'allPlans'));

	}

	// View Contact Us page
	public function contact_us()
	{
		$title = 'Contact Us';
		return view('frontend.contact_us', compact('title'));
	}

	// Contact Us Email Section
	public function contact_us_email(Request $request)
	{
		$admin = User::where('role_id', 1)->first();
		$adminEmail = $admin->email;

		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$mobile_Number = $request->mobile_Number;
		$subject = $request->subject;
		$email = $request->email;
		$message = $request->message;

        $subject = 'Better Trend Contact';
    	$msg_templateAdmin = '
		    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
			    	<h3>Contact: </h3>
			    	<h4 style="padding: 0 20px 0 0;">Hello '.$admin->name.'! <br><br>
			    		'.$first_name.' have sent a message through the contact form.
			    		the details are below
			    	</h4>
			    	<p>
			    		<ul style="list-style: none;">
			    			<li>First Name: '.$first_name.'</li>
			    			<li>Last Name: '.$last_name.'</li>
			    			<li>Mobile Number: '.$mobile_Number.'</li>
			    			<li>Subject: '.$subject.'</li>
			    			<li>Email: '.$email.'</li>
			    			<li>Message: '.$message.'</li>
			    		</ul>
			    	</p>
		    	</div>
		    	';
		$data = array( 'email' => $adminEmail, 'subject' => $subject, 'message' => $msg_templateAdmin);
		Mail::send([], $data, function ($m) use($data) {
           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
    	});
    	$msg_templateUser = '
    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
	    	<h3>Contact: </h3>
	    	<h4 style="padding: 0 20px 0 0;">Hello '.$first_name.' '.$last_name.'! <br><br>
	    	</h4>
	    	<br>
	    	<p>Thank you! we have received your Email and we usually response within 48 hours</p>
    	</div>
    	';
        
		$data = array( 'email' => $email, 'subject' => $subject, 'message' => $msg_templateUser);

		Mail::send([], $data, function ($m) use($data) {
           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
    	});
		return redirect()->back()->withInput()->with('message', 'Thank you for contacting us');
	}

	// View Terms and conditions Page
	public function terms()
	{
		$title = 'Terms and Conditions';
		return view('frontend.terms', compact('title'));
	}

	// View refund policy Page
	public function refund_policy()
	{
		$title = 'Refund Policy';
		return view('frontend.refund_policy', compact('title'));
	}

	// View Disclaimers Page
	public function disclaimers()
	{
		$title = 'Disclaimers';
		return view('frontend.disclaimers', compact('title'));
	}

	// View Partners Page
	public function our_partners()
	{
		$title = 'Our Partners';
		return view('frontend.our_partners', compact('title'));
	}

	// View podcasts Page
	public function podcasts()
	{
		$title = 'Podcasts';
		return view('frontend.podcasts', compact('title'));
	}

	// View media Page
	public function media()
	{
		$title = 'Media';
    	$youtubeVideos = VideoYoutube::where('status', 'active')->get();
    	$videosCategories = VideoYoutube::where('status', 'active')->groupBy('category')->get();
    	
    	$mediaImages = MediaImage::where('status', 'active')->get();
    	$imageCategories = MediaImage::where('status', 'active')->groupBy('category')->get();

    	$mediadocuments = MediaDocument::where('status', 'active')->get();
    	$documentCategories = MediaDocument::where('status', 'active')->groupBy('category')->get();

    	
		return view('frontend.media', compact('title', 'youtubeVideos', 'videosCategories', 'mediaImages', 'imageCategories', 'mediadocuments', 'documentCategories'));
	}

	// View Schools of users

	public function schools()
	{
		if (Auth::check()) {
	    	$user = Auth::user();
			$title = 'Purchased Schools';
	        $my_subscriptions = DB::table('users_subscription')
            ->join('schools_natives', 'users_subscription.school_id', '=', 'schools_natives.school_id')
	    	->select('schools_natives.*', 'users_subscription.*', 'users_subscription.school_id AS subscription_school_id', 'users_subscription.status AS subscription_status')
	    	->where([['users_subscription.user_id', $user->id], ['schools_natives.status', 'active'], ['schools_natives.lang', $this->langCode]])
            ->orderBy('users_subscription.id', 'DESC')
            ->get();

			return view('frontend.schools', compact('title', 'my_subscriptions'));
		} else {
			Session::put('url.intended', lang_url('schools'));
			return redirect(lang_url('userlogin'));
		}
	}

	// Course Detail Page
	public function school_detail($school_id, $subscriptions_id)
	{
		if (Auth::check()) {

			$user = Auth::user();

	        $schoolAccess = DB::table('users_subscription')
	        ->join('schools', 'users_subscription.school_id', '=', 'schools.id')
	        ->join('schools_natives', 'schools.id', '=', 'schools_natives.school_id')
	    	->select('schools_natives.*', 'users_subscription.*', 'schools.*', 'users_subscription.school_id AS subscription_school_id', 'users_subscription.status AS subscription_status', 'schools.id AS schoolID', 'schools.name AS schoolOriginalName')
	    	->where([['users_subscription.user_id', $user->id], ['users_subscription.id', $subscriptions_id], ['users_subscription.status', 'active'], ['schools.id', $school_id], ['schools_natives.school_id', $school_id], ['schools_natives.status', 'active'], ['schools_natives.lang', $this->langCode]])
	        ->first();

			if ($schoolAccess) {
	    		// Single School
		    	$schoolNative = School::find($school_id)->schoolDetail()->where([['lang', $this->langCode], ['status', 'active']])->first();
		    	
		    	$courseNative = CoursesNative::with('courses')->whereHas('courses', function ($query) use ($school_id) {
		    		$query->where('school_id', $school_id);
		    	})->where([['lang', $this->langCode], ['status', 'active']])->get();
		    	
		    	if (count($schoolNative) > 0) {
			    	
					$title = $schoolNative->name;
					return view('frontend.school_detail', compact('title', 'schoolNative', 'courseNative'));

		    	} else {
					return redirect(lang_url('schools'));
		    	}
			} else {
				return redirect(lang_url('schools'));
			}
		} else {
			Session::put('url.intended', lang_url('schools/'.$school_id.'/'.$subscriptions_id.'/view'));
			return redirect(lang_url('userlogin'));
		}
	}

	// View Schools

	public function allschools()
	{
		$title = 'All Schools';
    	$schoolNative = SchoolsNative::with('schools')->where([['lang', $this->langCode], ['status', 'active']])->get();
		return view('frontend.all_schools', compact('title', 'schoolNative'));
	}

	// School Detail Page
	public function school_view($school_id)
	{
    	// Single School
    	$schoolNative = School::find($school_id)->schoolDetail()->where([['lang', $this->langCode], ['status', 'active']])->first();
    	
    	if (count($schoolNative) > 0) {
	    	
			$title = $schoolNative->name;
			return view('frontend.school_view', compact('title', 'schoolNative'));

    	} else {
			return redirect(lang_url('allschools'));
    	}
	}

	// Chapter Detail Page
	public function chapter_detail($chapter_id)
	{
		if (Auth::check()) {
			$userAgent = $_SERVER['HTTP_USER_AGENT'];

			//chapters of single course

	    	$chapter = Chapter::find($chapter_id)->chapterDetail()->where([['lang', $this->langCode], ['status', 'active']])->first();

	    	if (count($chapter) > 0) {
		    	
				$title = $chapter->name;
				return view('frontend.chapter_detail', compact('title', 'chapter', 'userAgent'));

	    	} else {
				return redirect(lang_url('courses'));
	    	}

    	} else {
			Session::put('url.intended', lang_url('profile'));
			return redirect(lang_url('chapters/'.$chapter_id.'/view'));
    	}
	}

	// View all Courses Page
	public function courses()
	{
		$title = 'All Courses';
    	$courseNative = CoursesNative::with('courses')->where([['lang', $this->langCode], ['status', 'active']])->get();
		return view('frontend.courses', compact('title', 'courseNative'));
	}

	// Course Detail Page
	public function course_detail($course_id)
	{
		//categories of single course
		$categories = Course::find($course_id)->categories()->get();

    	// chapters of single course
    	$chapterNative = ChaptersNative::with('chapters')->whereHas('chapters', function ($query) use ($course_id) {
    		$query->where('course_id', $course_id);
    	})->where([['lang', $this->langCode], ['status', 'active']])->get();

    	// Single Course
    	$course = Course::find($course_id)->courseDetail()->where([['lang', $this->langCode], ['status', 'active']])->first();
    	if (count($course) > 0) {
	    	
			$title = $course->name;
			return view('frontend.courses_detail', compact('title', 'categories', 'course_id', 'course', 'chapterNative', 'categoryNative'));

    	} else {
			return redirect(lang_url('courses'));
    	}
	}

	// Watch Video Page
	public function watch_video($course_id, $video_id)
	{
		$videoNative = VideoNative::where([['id', $video_id], ['lang', $this->langCode], ['status', 'active']])->first();
    	if (count($videoNative) > 0) {

			$title = $videoNative->name;
			return view('frontend.video_watch', compact('title', 'course_id', 'videoNative'));

    	} else {
			return redirect(lang_url('courses/'.$course_id.'/view'));
    	}
	}

	// View All Coaches Page
	public function coaches()
	{
		$title = 'All Coaches';

		$requestStatus = NULL;
		if (Auth::check()) {
	        $user = Auth::user();
	        $foundRequest = AppliedCoach::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
	        if ($foundRequest) {
	        	if ($foundRequest->status == 'approve') {
					$requestStatus = NULL;
	        	} else {
		        	$requestStatus = $foundRequest->status;
	        	}
	        }
		}

		$allUsers = AppliedCoach::with('users')->whereHas('users', function ($query) {
    		$query->where('role_id', '2')->where('status', 'active');
    	})->where('status', 'approve')->get();
		
		return view('frontend.coaches', compact('title', 'allUsers', 'requestStatus'));
	}

	// View Plan FOrm Page
	public function buy_plan(Request $request)
	{
		$title = 'Buy Plan';
		$price = $request->price;
		$no = $request->no;
		$plan_name = $request->plan_name;
		$duration = $request->duration;
    	$schoolNative = SchoolsNative::with('schools')->where([['lang', $this->langCode], ['status', 'active']])->get();
		
		return view('frontend.plan_purchase', compact('title', 'schoolNative', 'no', 'price', 'plan_name', 'duration'));
	}

	// View About Page
	public function buy_plan_school(Request $request)
	{
		$user_id = Auth::user()->id;
		$plan_name = $request->plan_name;
		$no = $request->no;
		$price = $request->price;
		$package_start_date = $request->package_start_date;
		$package_end_date = $request->package_end_date;
		$school = $request->school;
		$status = 'active';

		// Start Payment Process
		// 

		// 
		// End Payment Process

		$userData = [
			'user_id' => $user_id,
			'school_id' => $school,
			'package_name' => $plan_name,
			'package_price' => $price,
			'status' => $status,
			'package_start_date' => $package_start_date,
			'package_end_date' => $package_end_date
		];

		$inserted = UserSubscription::insert($userData);

		if ($inserted) {
			return redirect(lang_url('thank_you'));
		} else {
			return redirect()->back()->with('error', 'Opps! something went wrong');
		}

	}


	// View Profile Page
	public function profile()
	{
		$title = 'Profile';
		if (Auth::check()) {
	        $UserTbl = Auth::user();
			return view('frontend.profile', compact('title', 'UserTbl'));
		} else {
			Session::put('url.intended', lang_url('profile'));
			return redirect(lang_url('userlogin'));
		}
	}

	
	public function coach_profile($user_id)
	{
		$title = 'Coach Profile';

		$allCoaches = AppliedCoach::with('users')->whereHas('users', function ($query) use ($user_id) {
    		$query->where('id', $user_id)->where('role_id', '2')->where('status', 'active');
    	})->where('status', 'approve')->first();

    	if ($allCoaches) {
			return view('frontend.coach_profile', compact('title', 'allCoaches'));
    	} else {
			return redirect(lang_url(''));
    	}


	}

	// Update  Profile
	public function update_my_data(Request $request)
	{
		$monthFolder =  date('FY');
		$user = Auth::user();
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$phone = $request->input('phone');
		$gender = $request->input('gender');
		$dob = $request->input('dob');
		$location = $request->input('location');
		$password = $request->input('password');

		if ($password == '') {
			$newPassword = $user->password;
		} else {
			$newPassword = bcrypt($password);
		}

		$oldPic = $user->avatar;
		if(Input::hasFile('profile_picture')) {
			$file = Input::file('profile_picture');
			$folder = 'storage/users/'.$monthFolder;
			$path = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
			$newPicName = 'users'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
			if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif') {
				return redirect()->back()->with('error', 'Only Image Allowed');
			}
			$upload_success = Input::file('profile_picture')->move($folder, $newPicName);

			if ($oldPic != 'users/default.png') {
				$myFile = public_path().'/storage/'.$oldPic;
				if(file_exists($myFile)){
					unlink($myFile);
				}
			}

			$fileName = $newPicName;
		} else {
			$fileName = $oldPic;
		}

		if (Auth::check()) {

			$userUpdate = [
				'name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone,
				'gender' => $gender,
				'birth_date' => $dob,
				'location' => $location,
				'password' => $newPassword,
	            'avatar' => $fileName,
		    ];
		    
	        $done = User::where('id', $user->id)->update($userUpdate);	

			return redirect()->back()->with('message', 'Profile updated successfully');

		} else {
			return redirect(lang_url('/'));
		}

	}

	// View My Purchases Page
	public function my_purchases()
	{
		$title = 'My Purchases';
		if (Auth::check()) {
	        $user = Auth::user();
	        $all_purchases = Order::with('ProductsNative')->where('user_id', $user->id)->get();
			return view('frontend.my_purchases', compact('title', 'all_purchases'));
		} else {
			Session::put('url.intended', lang_url('my_purchases'));
			return redirect(lang_url('userlogin'));
		}
	}

	// View My Subscription Page
	public function my_subscriptions()
	{
		$title = 'My Subscriptions';
		if (Auth::check()) {
	        $user = Auth::user();
	        $my_subscriptions = UserSubscription::where('user_id', $user->id)->get();
			return view('frontend.my_subscriptions', compact('title', 'my_subscriptions'));
		} else {
			Session::put('url.intended', lang_url('my_subscriptions'));
			return redirect(lang_url('userlogin'));
		}
	}

	// View My Training Activities Page
	public function training_activities()
	{
		$title = 'My Training Activities';
		$langCode = $this->langCode;
		if (Auth::check()) {
	        $user = Auth::user();

	        $training_activities = DB::table('course_subscriptions')
            ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
            ->join('events_natives', 'events_natives.event_id', '=', 'events.id')
	    	->select('course_subscriptions.*', 'events.*', 'events_natives.*', 'course_subscriptions.id AS subscriptionID')
	    	->where([['course_subscriptions.user_id', Auth::user()->id], ['course_subscriptions.status', 'active'], ['events_natives.lang', $this->langCode]])
            ->orderBy('course_subscriptions.id', 'DESC')
            ->get();


			return view('frontend.training_activities', compact('title', 'training_activities', 'langCode'));
		} else {
			Session::put('url.intended', lang_url('training_activities'));
			return redirect(lang_url('userlogin'));
		}
	}

	// View My Training Activities Detail Page
	public function activity_detail($subscription_id)
	{
		$title = 'Activity Detail';
		if (Auth::check()) {
	        $user = Auth::user();

	     $training_activity = DB::table('course_subscriptions')
            ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
            ->join('events_natives', 'events_natives.event_id', '=', 'events.id')
	    	->select('course_subscriptions.*', 'events.*', 'events_natives.*', 'course_subscriptions.id AS subscriptionID')
	    	->where([['course_subscriptions.id', $subscription_id], ['course_subscriptions.user_id', Auth::user()->id], ['course_subscriptions.status', 'active'], ['events_natives.lang', $this->langCode]])
            ->first();

            if ($training_activity) {
				return view('frontend.activity_detail', compact('title', 'training_activity'));
            } else {
				return redirect(lang_url('training_activities'));
            }


		} else {
			Session::put('url.intended', lang_url($subscription_id.'activity_detail'));
			return redirect(lang_url('userlogin'));
		}
	}


	// View Communication Contact Us
	public function communication()
	{
		$title = 'Contact Help Support';
		if (Auth::check()) {
	        $user = Auth::user();
			return view('frontend.communication', compact('title'));
		} else {
			Session::put('url.intended', lang_url('communication'));
			return redirect(lang_url('userlogin'));
		}
	}

	// Contact Us Email Section
	public function communication_contact_us_email(Request $request)
	{
		$admin = User::where('role_id', 1)->first();
		$mobile_Number = $admin->mobile_Number;
		$adminEmail = $admin->email;
		$subject = $request->subject;
		$email = $request->email;
		$message = $request->message;

        $subject = 'Better Trend Contact';
    	$msg_templateAdmin = '
		    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
			    	<h3>Contact: </h3>
			    	<h4 style="padding: 0 20px 0 0;">Hello '.$admin->name.'! <br><br>
			    		'.Auth::user()->name.' have sent a message through the Commnunication Form.
			    		the details are below
			    	</h4>
			    	<p>
			    		<ul style="list-style: none;">
			    			<li>Email: '.$email.'</li>
			    			<li>Mobile Number: '.$mobile_Number.'</li>
			    			<li>Subject: '.$subject.'</li>
			    			<li>Message: '.$message.'</li>
			    		</ul>
			    	</p>
		    	</div>
		    	';
		$data = array( 'email' => $adminEmail, 'subject' => $subject, 'message' => $msg_templateAdmin);
		// Mail::send([], $data, function ($m) use($data) {
  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
  //   	});
    	$msg_templateUser = '
    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
	    	<h3>Contact: </h3>
	    	<h4 style="padding: 0 20px 0 0;">Hello! <br><br></h4>
	    	<br>
	    	<p>we received your Email and thank you to contact us and we usually response within 48 hours</p>
    	</div>
    	';
        
		$data = array( 'email' => $email, 'subject' => $subject, 'message' => $msg_templateUser);

		// Mail::send([], $data, function ($m) use($data) {
  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
  //   	});
		return redirect()->back()->withInput()->with('message', 'Thank you for contacting us');
	}

	// Email Subscribe Form Submitted
	public function email_subscribe_user(Request $request)
	{
		$email = $request->email;
		$status = 'active';

		$subscribed = [
			'email' => $email,
			'status' => $status,
			'created_at' => Carbon::now()
		];

		if (filter_var($email, FILTER_VALIDATE_EMAIL) ) {
			$emailFound = EmailSubscribe::where('email', $email)->first();
			if ($emailFound) {
				return redirect()->back()->withInput()->with('emailSubscriptionError', 'You have already subscribed');
			} else {
				$inserted = EmailSubscribe::insert($subscribed);

				return redirect()->back()->withInput()->with('emailSubscriptionMessage', 'You have successfully subscribed');
			}
		} else {
			return redirect()->back()->withInput()->with('emailSubscriptionError', 'Incorrect Email Address');
		}

	}

	

	// Apply to be a coach form
	// public function be_a_coach()
	// {
	// 	$title = 'Apply to be a coach';
 //        $requestStatus = NULL;
	// 	if (Auth::check()) {
	//         $user = Auth::user();
	//         $foundRequest = AppliedCoach::where('user_id', $user->id)->first();
	//         if ($foundRequest) {
	//         	$requestStatus = $foundRequest->status;
	//         	if ($requestStatus != 'approve') {
	// 				return view('frontend.be_a_coach', compact('title', 'requestStatus'));
	//         	} else {
	// 				return redirect(lang_url('profile'));	
	//         	}
	//         } else {
	// 			return view('frontend.be_a_coach', compact('title', 'requestStatus'));
	//         }
	// 	} else {
	// 		Session::put('url.intended', lang_url('be_a_coach'));
	// 		return redirect(lang_url('userlogin'));
	// 	}
	// }

	// be a coach request submit
	public function be_a_coach_submit(Request $request)
	{
		$monthFolder =  date('FY');

		$exp_attch = [];
		$cert_attch = [];
		$edu_attc = [];
		$lic_attch = [];

		if(Input::hasFile('exp_attch')) {
			$expfiles = Input::file('exp_attch');
			foreach ($expfiles as $key => $expfile) {

				$originalName = $expfile->getClientOriginalName();

				$folder = 'storage/applied-coach/'.$monthFolder;
				$path = pathinfo($expfile->getClientOriginalName(), PATHINFO_EXTENSION);
				$newPicName = 'applied-coach'.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
				if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif' &&  $path != 'bmp') {
					return redirect()->back()->with('error', 'Only (png,jpg,jpeg,gif,bmp,pdf) Allowed');
				}

				if ($expfile->getSize() > 11140000) {
					return redirect()->back()->with('error', 'Max upload File Allowed upto 10 MB');
				}

				$upload_success = $expfile->move($folder, $newPicName);
				if (count($upload_success) === 1) {
					$newUpload = [
						'download_link' => $newPicName,
						'original_name' => $originalName
					];
					array_push($exp_attch, json_encode($newUpload));
				}
			}
			$exp_attch = '['.implode(",",$exp_attch).']';
		} else {
			$exp_attch = '[]';
		}

		if(Input::hasFile('cert_attch')) {
			$certfiles = Input::file('cert_attch');
			foreach ($certfiles as $key => $certfile) {

				$originalName = $certfile->getClientOriginalName();

				$folder = 'storage/applied-coach/'.$monthFolder;
				$path = pathinfo($certfile->getClientOriginalName(), PATHINFO_EXTENSION);
				$newPicName = 'applied-coach'.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
				if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif' &&  $path != 'bmp') {
					return redirect()->back()->with('error', 'Only (png,jpg,jpeg,gif,bmp,pdf) Allowed');
				}

				if ($certfile->getSize() > 11140000) {
					return redirect()->back()->with('error', 'Max upload File Allowed upto 10 MB');
				}

				$upload_success = $certfile->move($folder, $newPicName);
				if (count($upload_success) === 1) {
					$newUpload = [
						'download_link' => $newPicName,
						'original_name' => $originalName
					];
					array_push($cert_attch, json_encode($newUpload));
				}
			}
			$cert_attch = '['.implode(",",$cert_attch).']';
		} else {
			$cert_attch = '[]';
		}

		if(Input::hasFile('edu_attc')) {
			$edufiles = Input::file('edu_attc');
			foreach ($edufiles as $key => $edufile) {

				$originalName = $edufile->getClientOriginalName();

				$folder = 'storage/applied-coach/'.$monthFolder;
				$path = pathinfo($edufile->getClientOriginalName(), PATHINFO_EXTENSION);
				$newPicName = 'applied-coach'.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
				if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif' &&  $path != 'bmp') {
					return redirect()->back()->with('error', 'Only (png,jpg,jpeg,gif,bmp,pdf) Allowed');
				}

				if ($edufile->getSize() > 11140000) {
					return redirect()->back()->with('error', 'Max upload File Allowed upto 10 MB');
				}

				$upload_success = $edufile->move($folder, $newPicName);
				if (count($upload_success) === 1) {
					$newUpload = [
						'download_link' => $newPicName,
						'original_name' => $originalName
					];
					array_push($edu_attc, json_encode($newUpload));
				}
			}
			$edu_attc = '['.implode(",",$edu_attc).']';
		} else {
			$edu_attc = '[]';
		}

		if(Input::hasFile('lic_attch')) {
			$licfiles = Input::file('lic_attch');
			foreach ($licfiles as $key => $licfiles) {

				$originalName = $licfiles->getClientOriginalName();

				$folder = 'storage/applied-coach/'.$monthFolder;
				$path = pathinfo($licfiles->getClientOriginalName(), PATHINFO_EXTENSION);
				$newPicName = 'applied-coach'.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
				if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif' &&  $path != 'bmp') {
					return redirect()->back()->with('error', 'Only (png,jpg,jpeg,gif,bmp,pdf) Allowed');
				}

				if ($licfiles->getSize() > 11140000) {
					return redirect()->back()->with('error', 'Max upload File Allowed upto 10 MB');
				}

				$upload_success = $licfiles->move($folder, $newPicName);
				if (count($upload_success) === 1) {
					$newUpload = [
						'download_link' => $newPicName,
						'original_name' => $originalName
					];
					array_push($lic_attch, json_encode($newUpload));
				}
			}
			$lic_attch = '['.implode(",",$lic_attch).']';
		} else {
			$lic_attch = '[]';
		}

		$admin = User::where('role_id', '1')->first();
		$adminEmail = $admin->email;

		$role_id = NULL;
		$getInsertedId = NULL;

		if (Auth::check()) {
			$role_id = Auth::user()->role_id;
			if ($role_id == '1') {
				return redirect()->back()->with('error', 'You don\'t have acces to be a coach');
			} elseif ($role_id == '2') {
				return redirect()->back()->with('error', 'You are already coach');
			} else {
				$getInsertedId = Auth::user()->id;
		        $foundRequest = AppliedCoach::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
		        if ($foundRequest->status == 'pending') {
					return redirect()->back()->with('error', 'You have already sent request');
		        }
			}
		} else {

			$name = $request->input('name');
			$email = $request->input('email');
			$phone = $request->input('phone');
			$password = uniqid();

		    $haveUser = User::WHERE('email', $email)->first();
		    if ($haveUser) {
				$getInsertedId = $haveUser->id;

				if ($haveUser->role_id == '1') {
					return redirect()->back()->with('error', 'You don\'t have acces to be a coach');
				} elseif ($haveUser->role_id == '2') {
					return redirect()->back()->with('error', 'You are already coach');
				} else {
					$getInsertedId = $haveUser->id;
			        $foundRequest = AppliedCoach::where('user_id', $haveUser->id)->orderBy('id', 'DESC')->first();
			        if ($foundRequest->status == 'pending') {
						return redirect()->back()->with('error', 'You have already sent request');
			        }
				}

		    }

			$authenticateResult = $this->register_authenticate($email);
			if ($authenticateResult === true) {
				$hashKey = uniqid(time());
				$user = [
				    'name' => $name,
				    'role_id' => 3,
				    'email' => $email,
				    'phone' => $phone,
				    'password' => bcrypt($password),
				    'status' => 'active',
				    'type' => 'user',
				    'settings' => '{"locale":"en"}',
				    'created_at' => Carbon::now()
				];
				$insertedUser = User::insert($user);
				$getInsertedId = DB::getPdo()->lastInsertId();
					$role = [
						'user_id' => $getInsertedId,
						'role_id' => 3,
					];
				DB::table('user_roles')->insert($role);
			}
			//  else {
			// 	$foundRequest = AppliedCoach::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
		 //        if ($foundRequest->status == 'pending') {
			// 		return redirect()->back()->with('error', 'You have already sent request');
		 //        }
			// }
		}

        $user_id = $getInsertedId;
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $experience = $request->experience;
        $certificates = $request->certificates;
        $education = $request->education;
        $training_license = $request->training_license;
        $about_coach = $request->about_coach;
        $status = 'pending';

        $updateRequestedCoach = [
        	'user_id' => $user_id,
        	'name' => $name,
        	'phone' => $phone,
        	'email' => $email,
        	'experience' => $experience,
        	'exp_attch' => $exp_attch,
        	'certificates' => $certificates,
        	'cert_attch' => $cert_attch,
        	'education' => $education,
        	'edu_attc' => $edu_attc,
        	'training_license' => $training_license,
        	'lic_attch' => $lic_attch,
        	'about_coach' => $about_coach,
        	'status' => $status,
			'created_at' => Carbon::now()
        ];

		$subject = 'Request to be a Coach - Better Trend';

        $requestAdded = AppliedCoach::insert($updateRequestedCoach);
		$last_id = DB::getPdo()->lastInsertId();
		if (count($last_id) > 0) {
	    	$msg_templateAdmin = '
			    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
				    	<h3>Contact: </h3>
				    	<h4 style="padding: 0 20px 0 0;">Hello '.$admin->name.'! <br><br>
				    		'.$name.' ('.$email.') sent a request to be a coach.
				    		the details are below
				    	</h4>
				    	<p>
				    		<ul style="list-style: none;">
				    			<li>Name: '.$name.'</li>
				    			<li>Mobile Number: '.$phone.'</li>
				    			<li>Email: '.$email.'</li>
				    			<li>About user: '.$about_coach.'</li>
				    		</ul>
				    	</p>
			    	</div>
			    	';
			$data = array( 'email' => $adminEmail, 'subject' => $subject, 'message' => $msg_templateAdmin);
			// Mail::send([], $data, function ($m) use($data) {
	  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
	  //   	});

			$newNotification = [
				'table_ID' => $last_id,
				'slug' => 'applied-coach',
				'title' => 'Coach request',
				'short_desc' => $name.' has applied to be a coach',
				'url' => 'admin/applied-coach/'.$last_id.'/edit',
				'status' => 'pending',
			    'created_at' => Carbon::now()
			];

			Notification::insert($newNotification);

			return redirect()->back()->with('message', 'Thank you for your interest to be a coach. Your request has been sent successfully!');
		}
	}


	// Update Video Watched by user
	public function updatevideowatched(Request $request)
	{
		$user_id = $request->user_id;
		$object_id = $request->video_id;
		$next_video_id = (int)$request->next_video_id;
		$total_videos = (int)$request->total_videos;
		$chapter_id = $request->chapter_id;


		$object_typeVideo = 'video';
		$statusVideo = 'watched';
		$object_typeChapter = 'chapter';
		$statusChapter = 'completed';

		$insertAccess = [
			'user_id' => $user_id,
			'object_id' => $object_id,
			'object_type' => $object_typeVideo,
			'status' => $statusVideo,
		    'created_at' => Carbon::now()
		];

		$insertChapterAccess = [
			'user_id' => $user_id,
			'object_id' => $chapter_id,
			'object_type' => $object_typeChapter,
			'status' => $statusChapter,
		    'created_at' => Carbon::now()
		];

		
		$alreadyWatched = User_access::where([['user_id', $user_id], ['object_id', $object_id], ['object_type', $object_typeVideo]])->first();

		if (count($alreadyWatched) > 0) {
			// video already watch return 0 (do nothing)
			return 0;
		} else {

			$videoAccessInserted = User_access::insert($insertAccess);

			if ($videoAccessInserted) {
				
				$watchedvideoCount = User_access::where([['user_id', $user_id], ['object_type', $object_typeVideo]])->count();

				// last video of chapter
				// if (count($watchedvideoCount) == $total_videos) {
				if ($next_video_id == 0 ) {
					
					$chapterAccessInserted = User_access::insert($insertChapterAccess);
					
					// return 1 (record inserted in database)
					return 1;

				} else {

					$videoNative = VideoNative::where([['id', $next_video_id], ['lang', Request::locale()], ['status', 'active']])->first();
					
					// return next video
					$decodedVideo = json_decode($videoNative->video_upload);

					if (count($decodedVideo) > 0) {
						return '\\public\storage\\'.$decodedVideo[0]->download_link;
					} else {
						return 0;
					}

				}
			}
		}
	}

	// insert comment of video in database 
	public function submit_comment(Request $request){	

		$parentID = 0;

		if($request->has('parent_id')) {
			$parentID = $request->parent_id;
		}

		$newComment = [
			'comment' => $request->input('current_user_comment'),
			'video_id' => $request->input('video_id'),
			'user_id' => $request->input('user_id'),
			'coach_id' => $request->input('coach_id'),
			'parent_id' => $parentID,
			'status' => 'active',
			'created_at' => Carbon::now()
		];

		$commentInserted = DB::table('comments')->insertGetId($newComment);

		if ($commentInserted) {
			if ($parentID == 0) {
				return $commentInserted;
			} else {
				return $parentID;
			}
		} else {
			return NULL;
		}
	}

	// // view comments reply in backend
	// public function comments_reply_backend($comment_id)
	// {
 //        $dataType = Voyager::model('DataType')->where('slug', '=', 'comments')->first();
 //        $model = app($dataType->model_name);

 //        // Check if BREAD is Translatable
 //        if (($isModelTranslatable = is_bread_translatable($model))) {
 //            $dataTypeContent->load('translations');
 //        }
	// 	$usesSoftDeletes = true;
	// 	$showSoftDeleted = true;
 //        $isServerSide = isset($dataType->server_side) && $dataType->server_side;
		
 //        // GET THE DataType based on the slug

	// 	$dataTypeContent = DB::table('comments')->where('parent_id', $comment_id)->get();
	// 	$commentsReply = DB::table('comments')->where('id', $comment_id)->first();


 //    	return Voyager::view('vendor.voyager.comments.comments')->with(compact('dataTypeContent', 'commentsReply', 'dataType', 'usesSoftDeletes', 'showSoftDeleted', 'isServerSide', 'isModelTranslatable'));
	// }


	// video resume check
	public function videoStartsFrom(Request $request)
	{

		$videonative_id = $request->input('videonative_id');
		$user_id = $request->input('user_id');
		$haveResume = VideoResume::where([['video_id', $videonative_id], ['user_id', $user_id]])->orderBy('id', 'DESC')->first();

		if ($haveResume) {
			return $haveResume->time;
		} else {
			return NULL;
		}
	}

	// after video ended delete record of resume
	public function deleteVideoTime(Request $request)
	{
		$videonative_id = $request->input('videonative_id');
		$user_id = $request->input('user_id');
		$foundVideo = VideoResume::where([['video_id', $videonative_id], ['user_id', $user_id]])->first();
		if ($foundVideo) {
			VideoResume::where([['video_id', $videonative_id], ['user_id', $user_id]])->delete();
		}
	}

	// insert video time where to resume in db
	public function InsertVideoTime(Request $request)
	{
		$video_id = $request->input('videonative_id');
		$user_id = $request->input('user_id');
		$time = $request->input('ResumeTime');
		
		$newTime = [
			'video_id' => $video_id,
			'user_id' => $user_id,
			'time' => $time,
		    'created_at' => Carbon::now()
		];

		$foundVideo = VideoResume::where([['video_id', $video_id], ['user_id', $user_id]])->first();
		if ($foundVideo) {
			VideoResume::where([['video_id', $video_id], ['user_id', $user_id]])->update($newTime);
		} else {
			VideoResume::insert($newTime);
		}
	}

	// chapter start after video complete
	public function chapter_test($chapter_id)
	{
		$title = 'Chapter Test';
		if (Auth::check()) {
			$chapter_native = ChaptersNative::where('id', $chapter_id)->first();
			$allVideosWatched = User_access::where([['user_id', Auth::user()->id], ['object_id', $chapter_native->chapter_id], ['object_type', 'chapter'], ['status', 'completed']])->first();

			if ($allVideosWatched) {

		        $user = Auth::user();
		        $chapter = ChaptersNative::where('id', $chapter_id)->first();

		        $chapterExamQuestions = DB::table('exam')
	            ->join('test_questions', 'exam.id', '=', 'test_questions.exam_id')
	            ->join('test_answers', 'test_questions.id', '=', 'test_answers.question_id')
		    	->select('exam.*', 'test_questions.*', 'test_answers.*', 'test_answers.id AS test_answers_id')
		    	->where([['exam.chapter_id', $chapter_id], ['exam.status', 'active'], ['test_questions.question_status', 'active']])
	            ->inRandomOrder()
	            ->get();

				return view('frontend.chapter_test', compact('title', 'chapter', 'chapterExamQuestions'));

			}
		} else {
			Session::put('url.intended', lang_url('chapters/'.$chapter_id.'/test/serve'));
			return redirect(lang_url('userlogin'));
		}
	}

	// test answer insert in db with ajax
	public function test_answer(Request $request)
	{
		$user_id = $request->input('user_id');
		$exam_id = $request->input('exam_id');
		$question_id = $request->input('question_id');
		$answer_by_user = $request->input('answer');
		$remainingQuestions = (int)$request->input('remainingQuestions');
		$initPercentage = $request->input('initPercentage');
		$min_passing = $request->input('min_passing');
		$chapter_native_id = $request->input('chapter_native_id');
		$answer_status = FALSE;

		$ansCheck = TestAnswer::where('question_id', $question_id)->first();

		if ($ansCheck->correct_answer == $answer_by_user) {
			$answer_status = TRUE;
		}

		$insertAnswer = [
			'exam_id' => $exam_id,
			'user_id' => $user_id,
			'question_id' => $question_id,
			'answer_by_user' => $answer_by_user,
			'answer_status' => $answer_status,
		    'created_at' => Carbon::now()
		];

		$answerInserted = UserAnswer::insert($insertAnswer);
		if ($answerInserted) {

			$percentage = '10';

			if ($answer_status == TRUE) {
				$initPercentage = (int)$initPercentage + (int)$percentage;
			} 

			if ((int)$min_passing <= (int)$initPercentage ) {
			 	$overall_result = 'Passed';
			} else {
			 	$overall_result = 'Not Passed';
			}

			if ($remainingQuestions == 0) {

				$insertResult = [
					'exam_id' => $exam_id,
					'user_id' => $user_id,
					'percentage' => $initPercentage,
					'result' => $overall_result,
				    'created_at' => Carbon::now()
				];
				$resultInserted = TestResult::insert($insertResult);

				if ($resultInserted) {

					$insertChapterAccess = [
						'user_id' => $user_id,
						'object_id' => $chapter_native_id,
						'object_type' => 'test',
						'status' => $overall_result,
					    'created_at' => Carbon::now()
					];

					$chapterAccessInserted = User_access::insert($insertChapterAccess);
				}
				
			}

			$result = [
				'percentage' => $initPercentage,
				'result' => $overall_result,

			];

			return $result;
		}
	}

	
	public function all_tests()
	{
		$title = 'All Tests';
		if (Auth::check()) {
			$allTests = TestResult::with('exam')->where('user_id', Auth::user()->id)->get();
			return view('frontend.all_tests', compact('title', 'allTests'));
		} else {
			Session::put('url.intended', lang_url('all_tests'));
			return redirect(lang_url('userlogin'));
		}
	}

	// all events page
	public function events()
	{
		$title = 'Events';

		$eventNative = EventsNative::with('events')->where([['lang', $this->langCode], ['status', 'active']])->get();

		return view('frontend.all_events', compact('title', 'eventNative'));
	}

	//event detail page
	public function eventDetail($event_id)
	{
		$title = 'Event Detail';
		$eventNative = EventsNative::with('events')->where([['event_id', $event_id], ['lang', $this->langCode], ['status', 'active']])->first();

		if ($eventNative) {
			return view('frontend.event_detail', compact('title', 'eventNative'));
		} else {
			return redirect(lang_url(''));
		}
	}

	//enroll in an event
	public function enroll_course($course_id)
	{
		if (!Auth::check()) {
			Session::put('url.intended', lang_url($course_id.'/enroll_course'));
		}

		$title = 'Enroll in Course';

		$courseNative = CoursesNative::with('courses')->whereHas('courses', function ($query) use ($course_id) {
    		$query->where([['school_id', NULL], ['id', $course_id]]);
    	})->where([['lang', $this->langCode], ['status', 'active']])->first();

    	if (count($courseNative) > 0) {
    		if ($courseNative->course_enroll_status != 'finish' && $courseNative->course_enroll_status != 'cancelled' && $courseNative->course_enroll_status != 'closed' && $courseNative->course_enroll_status != 'on_hold') {
				return view('frontend.enroll_in_course', compact('title', 'courseNative'));
    		} else {
				return redirect(lang_url('events'));
    		}
    	} else {
			return redirect(lang_url('events'));
    	}
    	

	}

	// Enroll in course form
	public function enroll_form(Request $request)
	{
		$user_id =  NULL;
		$course_id = $request->input('course_id');
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$mobile_number = $request->input('mobile_number');
		$email = $request->input('email');

		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$first_name = Auth::user()->name;
			$last_name = Auth::user()->last_name;
			$mobile_number = Auth::user()->phone;
			$email = Auth::user()->email;
		}

		$enrollCourse = [
			'user_id' => $user_id,
			'course_id' => $course_id,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'mobile_number' => $mobile_number,
			'email' => $email,
			'payment_status' => 'Not Paid',
			'paid' => '0',
			'enroll_date' => Carbon::now(),
			'instalment_no' => '0',
			'status' => 'active',
			'created_at' => Carbon::now(),
		];

		$enrolledCourse = DB::table('course_subscriptions')->insert($enrollCourse);
		$getInsertedId = DB::getPdo()->lastInsertId();

		if ($enrolledCourse) {
			return redirect(lang_url($course_id.'/payment_course/'.$getInsertedId));
		} else {
			return redirect(lang_url('events'));
		}


	}

	public function payment_course($course_id, $subscriptions_id)
	{
		if (!Auth::check()) {
			Session::put('url.intended', lang_url($course_id.'/payment_course/'.$subscriptions_id));
		}

		$title = 'Course Enroll Payment';

		$subscription = DB::table('course_subscriptions')->where('id', $subscriptions_id)->first();

		$courseNative = CoursesNative::with('courses')->whereHas('courses', function ($query) use ($course_id) {
    		$query->where([['school_id', NULL], ['id', $course_id]]);
    	})->where([['lang', $this->langCode], ['status', 'active']])->first();

    	if (count($courseNative) > 0 && count($subscription) > 0) {

    		if ($subscription->payment_status == 'Not Paid' || $subscription->payment_status == 'Partially Paid') {
				return view('frontend.course_payment', compact('title', 'courseNative', 'subscription'));
    		} else {
				return redirect(lang_url('events'));
    		}

    	} else {
			return redirect(lang_url('events'));
    	}

	}

	public function enroll_course_payment(Request $request)
	{
		$subscription_id = $request->input('subscription_id');
		$payment_type = $request->input('payment_type');
		$payment_options = $request->input('payment_options');
		$cardNumber = $request->input('cardNumber');
		$cardExpiry = $request->input('cardExpiry');
		$cardCVC = $request->input('cardCVC');
		$couponCode = $request->input('couponCode');
		$course_price = $request->input('course_price');
		$coupen_status = $request->input('coupen_status');
		$discount_perc = $request->input('discount_perc');
		$instalments = $request->input('instalments');

		$paid = '0';
		$instalment_no = '0';

		$alreadyEnrolled = DB::table('course_subscriptions')->where('id', $subscription_id)->first();

		if ($alreadyEnrolled->payment_status == 'Partially Paid') {
			$paid = $alreadyEnrolled->paid;
		}

		if ($coupen_status == '0') {
			$couponCode = NULL;
			$discount_perc = NULL;
		}

		if ($payment_type == 'offsite') {

			$payment_status = 'Pending';

		} else {

			if ($payment_options == 'one_payment') {

				$payment_status = 'Fully Paid';
				$paid = $course_price;

			} elseif ($payment_options == 'multiple_payment') {

				$instalment_no = (int)$alreadyEnrolled->instalment_no +1;

				if ($alreadyEnrolled->payment_status == 'Partially Paid') {

					$payment_status = 'Partially Paid';
					$paid = floatval($paid) + (floatval($course_price) / floatval($instalments));

					if ($paid == $course_price) {
						$payment_status = 'Fully paid';
					}

				} else {

					$payment_status = 'Partially Paid';
					$paid = floatval($course_price) / floatval($instalments);
					
				}


			}
		}



		// Start Payment Process
		// 

		// 
		// End Payment Process

		$enrollCoursePayment = [
			'paid' => $paid,
			'payment_status' => $payment_status,
			'promo_code' => $couponCode,
			'discount' => $discount_perc,
			'instalment_no' => $instalment_no,
		];

		$enrolledCourse = DB::table('course_subscriptions')->where('id', $subscription_id)->update($enrollCoursePayment);

		return redirect(lang_url('thank_you'));
	}
	
	// check coupen valid or not with ajax
	public function coupenCheck(Request $request)
	{
		$user_id = $request->input('user_id');
		$coupenCode = $request->input('coupenCode');
		$object_id = $request->input('object_id');
		$object_type = $request->input('object_type');


		$foundCode = PromoCode::where([['code', $coupenCode], ['object_id', $object_id], ['object_type', $object_type], ['status', 'active']])->whereDate('expiry_date', '>', date('Y-m-d'))->first();

		if (!$foundCode) {

			return 0;

		} else {

			if ($object_type == 'course') {

				$course_ = Course::where('id', $object_id)->first();
				if ($course_) {
					$discountedPrice = floatval($course_->price) - ((floatval($course_->price)*(int)$foundCode->discount)/100);

					$result = [
						'discountedPrice' => $discountedPrice,
						'discount' => $foundCode->discount,

					];

					return $result;
				} else {

					return 0;

				}

			}

		}

	}

	// ajax request for dropdown fields

	public function dropdownFieldSelect(Request $request)
	{
		$objectType = $request->input('objectType');
		if ($objectType == 'events') {
			$allData = DB::table($objectType)->where('coach_id', Auth::user()->id)->get();
		} else {
			$allData = DB::table($objectType)->where('user_id', Auth::user()->id)->get();
		}

		if ($allData) {
			return $allData;
		} else {
			return null;
		}

	}

	// Change language of backend
	public function changLangAdminPanel(Request $request)
	{

		

		$locale = '{"locale":"'.$request->input('locale').'"}';
		$user_id = Auth::user()->id;

		$langUpdate = [
			'settings' => $locale
		];


		User::where('id', $user_id)->update($langUpdate);
		return 1;
	}


	// Get new notifications in ever 5 sec with ajax
	public function getNotifications(Request $request)
	{
	    $oldId = $request->input('notification_id');


	    $html = '';

	    $newNotifications = Notification::where('id', '>', $oldId)->orderBy('id', 'DESC')->get();

	    $notificationCount = count($newNotifications);

	    if($notificationCount > 0) {
	        

	        foreach($newNotifications as $notification) {  

                $date = \Carbon\Carbon::parse($notification->created_at); 
                
                $duration = $date->diffForHumans(\Carbon\Carbon::now());

                if ($notification->slug == 'applied-coach') {
                  $title_class = '';
                } else {
                  $title_class = '';
                }

                $html .= '
				<a href="'.lang_url($notification->url).'" class="unread_notification" data-notif_id="'.$notification->id.'">
				  <div class="media">
				    <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
				    <div class="media-body">
				      <input type="hidden" class="notification_id" value="'.$notification->id.'" />
				      <h6 class="media-heading '. $title_class.'">'. $notification->title.'</h6>
				      <p class="notification-text font-small-3 text-muted">'.$notification->short_desc.'</p><small>
				        <time class="media-meta text-muted">'.$duration.'</time></small>
				    </div>
				  </div>
				</a>
                ';

	        }
	    }

	    $data = json_encode([
	                'htmlContent' => $html,
	                'count' => $notificationCount ,
	            ]);
	   
	    echo $data;
	    
	}

	// Admin route (Read Notification)
	public function read_notification(Request $request)
	{
	    $notif_id = $request->input('notification_id');

	    $statusRead = [
	    	'status' => 1
	    ];
	    $newNotifications = Notification::where('id', $notif_id)->update($statusRead);

	}

	public function listings()
	{
		$title = 'Plans and Pricing';
		$type = 'tool';
		//$type1 = 'book';
		$allPlans = SchoolPlan::where('status', 'active')->get();
		$products = ProductsNative::with('productSpec')->whereHas('productSpec', function ($query) use ($type) {
			$query->where('type', $type);
		})->where([['lang', $this->langCode], ['status', 'active']])->get();
		$productsDecode = json_decode($products);


		$products1 = ProductsNative::with('productSpec')->whereHas('productSpec', function ($query) use ($type) {
			$query->where('type', 'book');
		})->where([['lang', $this->langCode], ['status', 'active']])->get();
		$productsDecode1 = json_decode($products1);


		$schoolNative = SchoolsNative::with('schools')->where([['lang', $this->langCode], ['status', 'active']])->get();
		//return view('frontend.all_schools', compact('title', 'schoolNative'));

		//return view('frontend.books', compact('title', 'productsDecode', 'type'));
		$eventNative = EventsNative::with('events')->where([['lang', $this->langCode], ['status', 'active']])->get();
		

		return view('frontend.all_listings', compact('title', 'allPlans', 'productsDecode',  'productsDecode1','type', 'schoolNative','eventNative'));

	}

	

	

	

	

	



	
	// create GUID (General Uniquq ID)
	function getGUID(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = chr(123)// "{"
	            .substr($charid, 0, 8).$hyphen
	            .substr($charid, 8, 4).$hyphen
	            .substr($charid,12, 4).$hyphen
	            .substr($charid,16, 4).$hyphen
	            .substr($charid,20,12)
	            .chr(125);// "}"
	        return $uuid;
	    }
	}
	

}
