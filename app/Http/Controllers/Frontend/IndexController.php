<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Input;
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
				return redirect(lang_url(''));
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
		return redirect(lang_url('userlogin'));
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
		$mobile = $request->input('mobile');
		$password = $request->input('password');

		$authenticateResult = $this->register_authenticate($email);
		if ($authenticateResult === true) {
		$hashKey = uniqid(time());
		$employee = [
		    'name' => $name,
		    'mobile' => $mobile,
            'hash_key' => $hashKey,
		    'email' => $email,
		    'gender' => 'Male',
		    'created_at' => Carbon::now(),
		  ];
		// $insertedEmployees = DB::table('employees')->insert($employee);
		// $getInsertedId = DB::getPdo()->lastInsertId();
       
		// if ($insertedEmployees) {
		// 	$confirm_email = uniqid(time()).uniqid();
		// 	$referral = strtoupper(substr($name, 0, 3)).substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
		// 	$user = [
	 //            'name' => $name,
	 //            'email' => $email,
	 //            'password' => bcrypt($password),
	 //            'context_id' => $getInsertedId,
		// 	    'marital_status' => 'Single',
	 //            'type' => '',
	 //            'hash_key' => $hashKey,
		// 	    'created_at' => Carbon::now(),
		// 	    'status' => 'deactive',
		// 	    'referral_code' => $referral,
		// 	    'confirm_email' => $confirm_email,
			    
	 //        ];
		// 	$insertedUsers = DB::table('users')->insert($user);
		// 	$earning = [
	 //            'earning' => 0,
		// 	    'status' => 'Initial',
		// 	    'user_id' => $getInsertedId,
	 //        ];
		// 	$insertedEarning = DB::table('earnings')->insert($earning);

		// 	if ($insertedUsers) {
		// 		// if ($type == 'doctor') {
		// 		// 	$role_id = 2;
		// 		// } else {
		// 			$role_id = 3;
		// 		// }
		// 		$role = [
		// 			'role_id' => $role_id,
		// 			'user_id' => $getInsertedId,
		// 		];
		// 		DB::table('role_user')->insert($role);
		// 	}
		// }
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

		return redirect(lang_url('userlogin'))->with('message', 'Registration Work in progress');
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

	// View Profile Page
	public function profile()
	{
		$title = 'Profile';
		if (Auth::check()) {
			$user = Auth::user();
	        $UserTbl = Auth::user();
			return view('frontend.profile', compact('title', 'UserTbl'));
		} else {
			return redirect(lang_url('/'));
		}
	}

	// Update Normal Profile
	public function update_my_data(Request $request)
	{
		$user = Auth::user();
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$mobile = $request->input('mobile');
		$address = $request->input('address');
		$password = $request->input('password');
		$password2 = $request->input('password2');

		if ($password != $password2) {
			return redirect()->back()->with('error', 'Password and Confirm password does not match');
		}

		if(Input::hasFile('profile_picture')) {
			$file = Input::file('profile_picture');
			$folder = public_path('upload');
			$filename = uniqid(time());
			$path = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
			if ($path != 'png' && $path != 'jpg' && $path != 'jpeg' && $path != 'gif') {
				return redirect()->back()->with('error', 'Only Image Allowed');
			}
			$upload_success = Input::file('profile_picture')->move($folder, $filename.'.'.$path);

			$oldPic = $user->profile_picture;
			if ($oldPic != NULL) {
				$myFile = public_path().'/upload/'.$oldPic;
				if(file_exists($myFile)){
					unlink($myFile);
				}
			}

			$fileName = $filename.'.'.$path;
		} else {
			$fileName = NULL;
		}

		if (Auth::check()) {

			$employee = [
		    'name' => $first_name,
		  ];

	        // $UpdateEmployee = DB::table('employees')->where('id', $user->id)->update($employee);

			$userUpdate = [
	            'name' => $first_name,
		    ];
		    
	        $done = User::where('id', $user->id)->update($userUpdate);	

			return redirect()->back()->with('message', 'Profile updated successfully');

		} else {
			return redirect(lang_url('/'));
		}

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
		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$email = $request->email;
		$message = $request->message;

    	$msg_template = '
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
			    			<li>Email: '.$email.'</li>
			    			<li>Message: '.$message.'</li>
			    		</ul>
			    	</p>
		    	</div>
		    	';
        
        $content = $msg_template;
        $subject = 'Contact';

		$data = array( 'email' => $admin->email, 'subject' => $subject, 'message' => $content);
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
		return view('frontend.media', compact('title'));
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
    	// if (count($course) > 0) {
			$title = 'Video';
			return view('frontend.video_watch', compact('title'));

   //  	} else {
			// return redirect(lang_url('courses'));
   //  	}
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
