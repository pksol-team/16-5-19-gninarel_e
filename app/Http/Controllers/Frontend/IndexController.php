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
use Mail;
use Log;



class IndexController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	
	// View Home Page
	public function index($lang = NULL)
	{
		$title = 'Home';
		var_dump($lang);
		// return view('frontend.home', compact('title'));

	}

	// View Login Page
	public function login($lang = NULL)
	{
		$title = 'Login';
		if (Auth::check()) {
			return redirect('/');
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
				return redirect('/');
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
		return redirect('/userlogin');
	}

	// View About Page
	public function about()
	{
		$title = 'About';
		return view('frontend.about', compact('title'));
	}

	// View register Page
	public function register()
	{
		$title = 'Register';
		if (Auth::check()) {
			return redirect('/home');
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
		$insertedEmployees = DB::table('employees')->insert($employee);
		$getInsertedId = DB::getPdo()->lastInsertId();
       
		if ($insertedEmployees) {
			$confirm_email = uniqid(time()).uniqid();
			$referral = strtoupper(substr($name, 0, 3)).substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
			$user = [
	            'name' => $name,
	            'email' => $email,
	            'password' => bcrypt($password),
	            'context_id' => $getInsertedId,
			    'marital_status' => 'Single',
	            'type' => '',
	            'hash_key' => $hashKey,
			    'created_at' => Carbon::now(),
			    'status' => 'deactive',
			    'referral_code' => $referral,
			    'confirm_email' => $confirm_email,
			    
	        ];
			$insertedUsers = DB::table('users')->insert($user);
			$earning = [
	            'earning' => 0,
			    'status' => 'Initial',
			    'user_id' => $getInsertedId,
	        ];
			$insertedEarning = DB::table('earnings')->insert($earning);

			if ($insertedUsers) {
				// if ($type == 'doctor') {
				// 	$role_id = 2;
				// } else {
					$role_id = 3;
				// }
				$role = [
					'role_id' => $role_id,
					'user_id' => $getInsertedId,
				];
				DB::table('role_user')->insert($role);
			}
		}
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

		return redirect('/userlogin')->with('message', 'Registration completed successfully kindly login');
		} else {
			return redirect()->back()->withInput()->with('error', $authenticateResult);
		}
	}

	// email address check if already check
	public function register_authenticate($email)
	{
        $haveUser = DB::table('users')->WHERE('email', $email)->first();
        if ($haveUser) {
    		return $messsage = 'This email address is already registered!';
        }
        else {
        	return true;
        }
	}


	// View Forgot password Page
	public function forgot_password()
	{
		$title = 'Reset Password';
		if (Auth::check()) {
			return redirect('/userlogin');
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
			return redirect('/home');
		} else {
			$userGet = User::where('GUID', $GUID)->first();
			if ($userGet != NULL) {
				return view('frontend.reset_password', compact('title', 'userGet'));
			} else {
				return redirect('/');
			}
		}
	}

	// update new password after forgot
	public function forgot_reset_password(Request $request)
	{
		if (Auth::check()) {
			return redirect('/');
		} else {
			$GUID = $request->input('GUID');
			$password = $request->input('password');
			$confirm_password = $request->input('confirm_password');
			if ($password == $confirm_password) {
		    	$Updatepassword = ['password' => bcrypt($confirm_password), 'GUID' => NULL];
		        $UserUpd = User::where('GUID', $GUID)->update($Updatepassword);
		        if ($UserUpd == TRUE) {
					return redirect('/userlogin')->with('message', 'Contraseña restablecida con éxito');
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
			// return redirect('/');
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
			return redirect('/');
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
			return redirect('/');
		}

	}

	// View all Prducts
	public function products()
	{
		$title = 'All Products';
		$user = Auth::user();
		return view('frontend.profile', compact('title'));
	}

	

	

	















	// View Publisher Earning
	
	public function earnings()
	{
		$title = 'Earnings';
		if (Auth::check()) {
			$userID = Auth::user()->id;
			$currentMonth = date('m');
	        $allEarnings = Earning::where('user_id', $userID)->orderBy('id', 'DESC')->get();
	        $todayEarning = Earning::where('user_id', $userID)->where('date', date('Y-m-d'))->sum('earning');
	        $monthlyEarning = Earning::where('user_id', $userID)->whereRaw('MONTH(date) = ?',[$currentMonth])->sum('earning');
	        if ($todayEarning == NULL) {
	        	$todayEarning = 0;
	        }
	        if ($monthlyEarning == NULL) {
	        	$monthlyEarning = 0;
	        }
			return view('frontend.earnings', compact('title', 'allEarnings', 'todayEarning', 'monthlyEarning'));
		} else {
			return redirect('/userlogin');
		}
	}
	// VIew Active Task
	public function active_tasks()
	{
		$title = 'Active';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $allActiveTasks = Employee::find($userID)->tasks()->where('task_joins.status', 'Pending')->orwhere([['task_joins.status', 'Submitted'], ['task_joins.user_id', $userID]])->orderBy('task_joins.id', 'DESC')->get();
			return view('frontend.active', compact('title', 'allActiveTasks'));
		} else {
			return redirect('/userlogin');
		}
	}

	// VIew Completed Task
	public function completed_tasks()
	{
		$title = 'Completed';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $allCompletedTasks = Employee::find($userID)->tasks()->where('task_joins.status', 'Completed')->orderBy('task_joins.id', 'DESC')->get();
	        
			return view('frontend.completed', compact('title', 'allCompletedTasks'));
		} else {
			return redirect('/userlogin');
		}
	}

	// View withdrawals Page
	public function withdrawals()
	{
		$title = 'Withdrawals';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $allWithdrawals = Withdrawal::where('user_id', $userID)->orderBy('id', 'DESC')->get();
	       
			return view('frontend.withdrawals', compact('title', 'allWithdrawals'));
		} else {
			return redirect('/userlogin');
		}
	}

	//Create New Withdrawal
	public function create_withdrawal()
	{
		$title = 'Create Withdrawal';
		if (Auth::check()) {
			$userID = Auth::user()->id;
	    	$allBanksencoded = User_Account::with('bank')->where('user', $userID)->get();
	    	$allBanks = json_decode($allBanksencoded);

			return view('frontend.create_withdrawal', compact('title', 'allBanks'));
		} else {
			return redirect('/userlogin');
		}
	}

	public function request_withdrawal(Request $request)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $requestedAmount = $request->amount;
	        $bank = $request->bank;
	        $haveBank = User_Account::where('user', $userID)->where('bank', $bank)->first();
	        $empEarnings = Earning::where('user_id', $userID)->sum('earning');

	        if ($requestedAmount < 10 ) {
				return redirect()->back()->with('errorAmount', 'Minimum withdrawal amount is $10');
	        }
	        if (!$haveBank) {
				return redirect()->back()->with('errorAmount', 'This Bank is Not in records');
	        }
	        if ($requestedAmount > $empEarnings) {
				return redirect()->back()->with('errorAmount', 'Your balance is less then requested amount');
	        }

	        $withdrawal = [
	        	'to' => 'testing',
	        	'date' => Carbon::now()->toDateString(),
	        	'amount' => $requestedAmount,
	        	'user_id' => $userID,
	        	'bank' => $bank,
	        	'account_number' => $haveBank->account_number
	        ];

	        $inserted = Withdrawal::insert($withdrawal);
	        return redirect('/withdrawals')->with('message', 'Your request has been sent for approval');

		} else {
			return redirect('/userlogin');
		}
	}

	//Create New Withdrawal
	public function advertiser_earnings()
	{
		$title = 'Buy Credit';
		if (Auth::check()) {
			$userID = Auth::user()->id;
			return view('frontend.advertiser_credit', compact('title'));
		} else {
			return redirect('/userlogin');
		}
	}

	// Join Task 
	public function join_task(request $request)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
	        $task_join_insert = [
	        	'task_id' => $request->task_id,
	        	'user_id' => $userID,
	        ];

	        Task_Join::insert($task_join_insert);
	        return redirect()->back();

		} else {
			return redirect('/userlogin');
		}
	}

	// cancel Task
	
	public function cancelwork(request $request)
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;

	        DB::table('task_joins')->where([['user_id', $userID], ['task_id', $request->task_id]])->delete();
	        return redirect()->back();

		} else {
			return redirect('/userlogin');
		}
	}

	// Submit Task
	public function submit_task(request $request)
	{
		if (Auth::check()) {

			$userID = Auth::user()->id;
	        $task_join_row = Task_Join::where([['task_id', $request->task_id], ['user_id', $userID]]);
			$user = $task_join_row->first();

			if(Input::hasFile('screenshots')) {

		        $images = $request->file('screenshots');
		        $newPhotosStr = [];
		        foreach ($images as $key => $image) {
		        	if ($image == NULL) {
		        		continue;
		        	}
			        $extension = $image->getClientOriginalExtension();
					$imageName = uniqid(time()).'.'.$extension;
			        $image->move(public_path('upload'), $imageName);

					$newPhotos = '"'.$imageName.'"';
					array_push($newPhotosStr, $newPhotos);
		        }
				$newPhotosStr = implode(",",$newPhotosStr);

				$updatePhotos = [
			        	'status' => 'Submitted',
			            'uploads' => $newPhotosStr
				    ];
		        $done = $task_join_row->update($updatePhotos);
		        return redirect()->back();
			} else {
		        return redirect()->back()->with('error', 'The screenshots field is required.');
			}
		} else {
			return redirect('/userlogin');
		}
	}

	// Work Submitted view for advertiser
	
	public function work_submitted()
	{
		if (Auth::check()) {
			$userID = Auth::user()->id;
			$title = 'All Works Submitted';
			// $tasks = DB::table('task_joins')->where('tasks.user_id', $userID)
			// ->leftjoin('tasks','task_joins.task_id', '=', 'tasks.id')
			// ->leftjoin('employees','task_joins.user_id', '=', 'employees.id')
			// ->get();

			$task = Task::where('user_id', $userID)->get();
			var_dump($task->employee);



			// return view('frontend.work_submitted', compact('title', 'tasks'));

		} else {
			return redirect('/userlogin');
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
	
	// Contact Us page
	public function contact_us()
	{
		$title = 'Contáctenos';
		return view('frontend.contact_us', compact('title'));
	}

	// Contact Us Email Section
	public function contact_us_email(Request $request)
	{
		$admin = DB::table('employees')->where('type', 'admin')->first();
		$reason = $request->reason;
		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$email = $request->email;
		$comment = $request->comment;

    	$baseUrl = url('/');
    	$msg_template = '
		    	<div style="text-align: left;padding-left: 20px;padding-top: 50px;padding-bottom: 30px;">
			    	<h3>psicologosVibemar.cl contacto: </h3>
			    	<h4 style="padding: 0 20px 0 0;">Hola '.$admin->first_name.'! <br><br>
			    		'.$first_name.' ha enviado un mensaje a través del formulario de contacto.
			    		abajo están los detalles
			    	</h4>
			    	<p>
			    		<ul style="list-style: none;">
			    			<li>Razón: '.$reason.'</li>
			    			<li>Nombre de pila: '.$first_name.'</li>
			    			<li>apellido: '.$last_name.'</li>
			    			<li>correo electrónico: '.$email.'</li>
			    			<li>Comentario: '.$comment.'</li>
			    		</ul>
			    	</p>
		    	</div>
		    	';
        
        //Updating Email content [Metakey]
        $content = $msg_template;
        $subject = 'Contacto';

		$data = array( 'email' => $admin->email, 'subject' => $subject, 'message' => $content);
		Mail::send([], $data, function ($m) use($data) {
           $m->to($data['email'])->subject($data['subject'])->setBody($data['message'], 'text/html');
    	});
		return redirect()->back()->withInput()->with('message', 'Gracias por contactarnos');
	}

}
