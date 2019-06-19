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
use Mail;
use Log;



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
				Auth::attempt(['email' => $email, 'password' => $password]);
				if (session()->has('url.intended')) {
					return redirect()->intended();
				} else {
					$request->session()->forget('url.intended');
					return redirect(lang_url(''));
				}
			}
			else{
				return redirect()->back()->withInput()->with('error', 'User password does not match! If you do not have your account <a href="/userrregister">Register here </a>');
			}
		}else {
			return redirect()->back()->withInput()->with('error', 'This email address is not registered <a href="/userrregister">Register here </a>');
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
			return redirect(lang_url(''));
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
		    'role_id' => 2,
		    'email' => $email,
		    'phone' => $phone,
		    'password' => bcrypt($password),
		    'settings' => '{"locale":"en"}',
		    'created_at' => Carbon::now()
		];
		$insertedUser = User::insert($user);
		$getInsertedId = DB::getPdo()->lastInsertId();
			$role = [
				'user_id' => $getInsertedId,
				'role_id' => 2,
			];
		DB::table('user_roles')->insert($role);

		// var_dump($insertedUser);
		// var_dump($getInsertedId);
		// $baseUrl = url('/');
		// $msg_template = '
		// 	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
		// 		<h3>Le damos la bienvenida a registro psicologosVibemar.cl<br></h3>
		// 		<h4 style="padding: 0 20px 0 0;">
		// 			<span lang="ES-CL" style="font-size:11.0pt;line-height:107%;color:#3e4247">Gracias
		// 			por registrarse en. En las próximas 48-72 horas&nbsp;</span>
		// 			<strong>
		// 			<span lang="ES-CL" style="font-size:11.5pt;line-height:107%;color:#3e4247; border:none;padding:0">revisaremos
		// 			los datos de su perfil para asegurarnos de que son válidos.</span>
		// 			</strong><br>
		// 		</h4>
		// 		<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/verify_email/'.$getInsertedId.'/'.$confirm_email.'" style="color:#fff;">Confirme su correo electrónico aquí</a>
		// 		</button>
		// 	</div>
		// ';
		// $to = $email;
	 //    $subject = 'Registro de cuenta';
	 //    $content = $msg_template;

		// $data = array( 'email' => $to, 'subject' => $subject, 'message' => $content);
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
	    	// $PasswordKey = ['GUID' => $GUID];
	     //    $UserUpd = DB::table('users')->where('email', $email)->update($PasswordKey);

   //      	$baseUrl = url('/');
   //      	$msg_template = '
   //      		<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
			// 	<h3>psicologosVibemar.cl restablecimiento de contraseña: </h3>
			// 	<h4 style="padding: 0 20px 0 0;">Hola! <span style="color: #52a2f5;">'.$email.'</span>, Haga clic en el enlace de abajo para restablecer su contraseña</h4><h4 style="padding: 0 20px 0 0;"> </h4>
			// 	<button style="cursor: pointer;color: #fff;background-color: #28a745;border-color: #28a745;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;user-select: none;border: 1px solid transparent;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;border-radius: .25rem;"><a href="'.$baseUrl.'/enter_new_password/'.$GUID.'" style="color:#fff;">Restablecer la contraseña</a></button>
			// 	</div>';
            
   //          //Updating Email content [Metakey]
   //          $content = $msg_template;
   //          $subject = 'Restablecer la contraseña';

			// $data = array( 'email' => $email, 'subject' => $subject, 'message' => $content);
			// Mail::send([], $data, function ($m) use($data) {
	  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
	  //   	});
			return redirect()->back()->withInput()->with('message', 'Password Reset link send to your email kindly check your email');
		}else {
			return redirect()->back()->withInput()->with('error', 'This email address is not registered <a href="/register">Register here </a>');
		}
		
	}

	// enter new password after forgot page
	public function enter_new_password($GUID)
	{
		$title = 'Reset your password';
		if (Auth::check()) {
			return redirect(lang_url('home'));
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
					return redirect(lang_url('userlogin'))->with('message', 'Contraseña restablecida con éxito');
		        } else {
					return redirect()->back()->withInput()->with('error', '¡Uy! Algo salió mal..');
		        }
			} else {
				return redirect()->back()->with('error', 'Su contraseña y la contraseña de confirmación no coinciden');	
			}
		}
	}

	//view Confirm email page
	public function confirm_email($hash_key)
	{
		$title = 'Confirmar correo electrónico';
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
		$title = 'Correo electrónico de verificación';
        $userFound = DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->first();
        if ($userFound) {

        	$confirm_email = [
        		'confirm_email' => NULL,
        		'status' => 'active',
        	];
        
        	DB::table('users')->where([['id', $id], ['confirm_email', $hashkey]])->update($confirm_email);
        	$message = 'Gracias por verificar su correo electrónico. Por favor complete su perfil';

        } else {
        	$message = '¡Uy! Enlace caducado o cuenta ya confirmada';
        }
		return view('frontend.thankyou_email', compact('title', 'message'));
	}

	// View all Prducts
	public function products($type)
	{
		$title = 'All Products';

    	$products = ProductsNative::with('productSpec')->whereHas('productSpec', function ($query) use ($type) {
    		$query->where('type', $type);
    	})->where([['lang', $this->langCode], ['status', 'active']])->get();
    	$productsDecode = json_decode($products);

		return view('frontend.product', compact('title', 'productsDecode', 'type'));
	}

	// View all Prducts
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

		// Start Payment Process
		// 

		// 
		// End Payment Process

		$newOrder = [
			'product_native_id' => $product_native_id,
			'product_price' => $product_price,
			'total_price' => $total_price,
			'user_id' => $user->id,
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
		return view('frontend.plans_pricing', compact('title'));
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
		// Mail::send([], $data, function ($m) use($data) {
  //          $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
  //   	});
    	$msg_templateUser = '
    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
	    	<h3>Contact: </h3>
	    	<h4 style="padding: 0 20px 0 0;">Hello '.$first_name.' '.$last_name.'! <br><br>
	    	</h4>
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
		return view('frontend.media', compact('title', 'youtubeVideos'));
	}

	// View Schools of users

	public function schools()
	{
		if (Auth::check()) {
	    	$user = Auth::user();
			$title = 'Purchased Schools';
	        $my_subscriptions = DB::table('users_subscription')
            ->join('schools_natives', 'users_subscription.id', '=', 'schools_natives.school_id')
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
		$user = Auth::user();

		// $chapterAccess = DB::table('videos')->where('chapter_id', $chapter_id)->orderBy('id', 'ASC')->first();

    	// ->join('user_access', 'videos.id', '=', 'user_access.object_id')
    	// ->select('videos.*', 'user_access.*', 'user_access.id AS subscription_id')
    	// ->where([['videos.chapter_id', $chapter_id], ['user_access.user_id', $user->id], ['user_access.status', 'watched']])
    	// ->get();

		

		// chapters of single course

    	$chapter = Chapter::find($chapter_id)->chapterDetail()->where([['lang', $this->langCode], ['status', 'active']])->first();

    	if (count($chapter) > 0) {
	    	
			$title = $chapter->name;
			return view('frontend.chapter_detail', compact('title', 'chapter'));

    	} else {
			return redirect(lang_url('courses'));
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
		$allUsers = User::where([['role_id', '!=',  1], ['status', 'active']])->get();

		return view('frontend.coaches', compact('title', 'allUsers'));
	}

	// View Plan FOrm Page
	public function buy_plan(Request $request)
	{
		$title = 'Buy Plan';
		$price = $request->price;
		$no = $request->no;
		$plan_name = $request->plan_name;
    	$schoolNative = SchoolsNative::with('schools')->where([['lang', $this->langCode], ['status', 'active']])->get();
		if (($request->no != '1' && $request->no != '2' && $request->no != '3' && $request->no != '4') OR ($request->price != '100' && $request->price != '200' && $request->price != '500' && $request->price != '999'))
		{
			return redirect(lang_url('plans_pricing'));
		}
		return view('frontend.plan_purchase', compact('title', 'schoolNative', 'no', 'price', 'plan_name'));
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
		if ($no == '1') {
			$package_end_date = NULL;
		}
		$school = $request->school;
		$status = 'active';
		if (($request->no != '1' && $request->no != '2' && $request->no != '3' && $request->no != '4') OR ($request->price != '100' && $request->price != '200' && $request->price != '500' && $request->price != '999'))
		{
			return redirect(lang_url('plans_pricing'));
		}

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
			$newPicName = 'users'.DIRECTORY_SEPARATOR.$monthFolder.DIRECTORY_SEPARATOR.Str::random(20).'.'.$path;
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

	// View My Subscription Page
	public function training_activities()
	{
		$title = 'My Training Activities';
		if (Auth::check()) {
	        $user = Auth::user();
			return view('frontend.training_activities', compact('title'));
		} else {
			Session::put('url.intended', lang_url('training_activities'));
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
	public function be_a_coach()
	{
		$title = 'Apply to be a coach';
        $requestStatus = NULL;
		if (Auth::check()) {
	        $user = Auth::user();
	        $foundRequest = AppliedCoach::where('user_id', $user->id)->first();
	        if ($foundRequest) {
	        	$requestStatus = $foundRequest->status;
	        	if ($requestStatus != 'approve') {
					return view('frontend.be_a_coach', compact('title', 'requestStatus'));
	        	} else {
					return redirect(lang_url('profile'));	
	        	}
	        } else {
				return view('frontend.be_a_coach', compact('title', 'requestStatus'));
	        }
		} else {
			Session::put('url.intended', lang_url('be_a_coach'));
			return redirect(lang_url('userlogin'));
		}
	}

	// be a coach request submit
	public function be_a_coach_submit(Request $request)
	{
		$monthFolder =  date('FY');

		$exp_attch = [];
		$cert_attch = [];
		$edu_attc = [];
		$lic_attch = [];

		if (Auth::check()) {

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

			$admin = User::where('role_id', 1)->first();
			$adminEmail = $admin->email;

	        $user_id = Auth::user()->id;
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

	        $foundRequest = AppliedCoach::where('user_id', $user_id)->first();
	        if ($foundRequest) {
	        	if ($foundRequest->status == 'cancel') {
	        		$updated = AppliedCoach::where('id', $foundRequest->id)->update($updateRequestedCoach);
	        		
    		    	$msg_templateAdmin = '
    				    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
    					    	<h3>Contact: </h3>
    					    	<h4 style="padding: 0 20px 0 0;">Hello '.$admin->name.'! <br><br>
    					    		'.$name.' ('.$email.') again sent a request to be a coach.
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

					return redirect(lang_url('profile'))->with('message', 'Your request has been sent again successfully');
	        	} else {
					return redirect()->back();
	        	}
	        } else {
	        		$inserted = AppliedCoach::insert($updateRequestedCoach);

    		    	$msg_templateAdmin = '
    				    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
    					    	<h3>Contact: </h3>
    					    	<h4 style="padding: 0 20px 0 0;">Hello '.$admin->name.'! <br><br>
    					    		'.$name.' ('.$email.') have sent a request to be a coach.
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
					return redirect(lang_url('profile'))->with('message', 'Thank you for your interest to be a coach. Your request has been sent successfully!');
	        }
		} else {
			Session::put('url.intended', lang_url('be_a_coach'));
			return redirect(lang_url('userlogin'));
		}
	}


	// Update Video Watched by user
	public function updatevideowatched(Request $request)
	{
		$user_id = $request->user_id;
		$object_id = $request->video_id;
		$object_type = 'video';
		$status = 'watched';

		$insertAccess = [
			'user_id' => $user_id,
			'object_id' => $object_id,
			'object_type' => $object_type,
			'status' => $status,
		    'created_at' => Carbon::now()
		];
		$alreadyWatched = User_access::where([['user_id', $user_id], ['object_id', $object_id], ['object_type', $object_type]])->first();
		

		if (count($alreadyWatched) > 0) {
			return 0;
		} else {
			$alreadyWatched = User_access::insert($insertAccess);
			return 1;
		}
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
