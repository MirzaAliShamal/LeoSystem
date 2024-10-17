<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use App\Mail\ForgotPasswordMail;

use App\Mail\LoginVerification;
use App\Models\Student;

use App\Models\User;

use App\Notifications\SnsNotification;
use App\Notifications\TwilioSmsNotification;
use App\Providers\RouteServiceProvider;

use App\Traits\General;

use Aws\Sns\SnsClient;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Session;

use Illuminate\Validation\ValidationException;
use IvanoMatteo\LaravelDeviceTracking\Models\Device;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */


    use General;

    protected function showLoginForm()

    {
        Cookie::queue(Cookie::forget('_uuid_d'));

        $data['pageTitle'] = __('Login');

        $data['title'] = __('Login');

        return view('auth.login', $data);

    }

    public function secure_login(Request $request)
    {
        $sessionTimeout = 300;

        // Set the session cookie parameters
        session_set_cookie_params($sessionTimeout);
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $correctPassword = "secure1234"; // Replace with your actual password
            $enteredPassword = $request->input('password');

            if ($enteredPassword === $correctPassword) {
                $_SESSION["logged_in"] = true;
                $_SESSION["last_activity"] = time();
                return redirect('/');
            } else {

                return "Incorrect password. Please try again.";
            }
        }
    }

    public function secure_login_auth(Request $request)
    {
        $sessionTimeout = 300;

        // Set the session cookie parameters
        session_set_cookie_params($sessionTimeout);
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $correctPassword = "secure1234"; // Replace with your actual password
            $enteredPassword = $request->input('password');

            if ($enteredPassword === $correctPassword) {
                $_SESSION["logged_in"] = true;
                $_SESSION["last_activity"] = time();
                return redirect('/login');
            } else {

                return "Incorrect password. Please try again.";
            }
        }
    }


    public function secure_logout()
    {
        session_start();
        // Clear the session data
        session_unset();
        session_destroy();
    }

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }


    /**
     * Write code on Method
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector()
     */

    public function login(Request $request)

    {

        $request->validate([

            'email' => 'required',

            'password' => 'required',

        ]);

        if ($user = User::where('email', $request->input('email'))->first()) {
            if ($user->email_verified_at == null) {
                return redirect("login")->with([
                    'basic' => "<b>Unfortunately, Your Email Has Not Been Verified!</b> <p>Please, Go to Your Email and Confirm Your Email!</p> <b>Best Regards!</b>"
                ]);

            }
        } elseif (is_numeric($request->input('email')) && $user = User::where('email', $request->input('email'))->first()) {
            if ($user->email_verified_at == null) {
                return redirect("login")->with([
                    'basic' => "<b style='color:#c10b0b'><i>We are Sorry!</i></b><p>Unfortunately! Your Email, Phone Number <br>or Password Were Entered incorrectly!<br>Please, Try Again or Recover Password!</p><p><b><i>Best Regards!</i></b></p>"
                ]);
            }
        }

        $field = 'email';

        if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {

            $field = 'email';

        } elseif (is_numeric($request->input('email'))) {

            $field = 'mobile_number';

        }

        $request->merge([$field => $request->input('email')]);

        $credentials = $request->only($field, 'password');


        /*

        role 2 = instructor

        role 3 = student

        -----------------

        status 1 = Approved

        status 2 = Blocked

        status 0 = Pending

        */

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role == USER_ROLE_STUDENT && Auth::user()->student->status == STATUS_REJECTED) {

                Auth::logout();

//                return redirect("login")->with(['error' => __('Your account has been blocked!')]);
                return redirect()->route('login')->with(['error' => "<b><i>Thank you and We are Glade To See You Again!</i></b><p class='text-danger'>We Regret! Your Account Has Been Blocked!</p><p>Please Go to Your Email!</p><br><b><i>Best Regards!</i></b>"]);

            }

            if (Auth::user()->role == USER_ROLE_STUDENT && Auth::user()->student->status == STATUS_PENDING) {

                Auth::logout();

                return redirect("login")->with(['error' => __('Your account has been in pending status. Please wait until approval.')]);

            }

            if (Auth::user()->role == USER_ROLE_INSTRUCTOR && Auth::user()->student->status == STATUS_REJECTED && Auth::user()->instructor->status == STATUS_REJECTED) {

                Auth::logout();

                return redirect("login")->with(['error' => __('Your account has been blocked!')]);
            }

            if (get_option('registration_email_verification') == 1) {

                $user = Auth::user()->hasVerifiedEmail();

                if (!$user) {

                    Auth::logout();

                    return redirect("login")->with(['basic' => __('<b>Unfortunately, Your Email Has Not Been Verified!</b> <p>Please, Go to Your Email and Confirm Your Email!</p> <b>Best Regards!</b>')]);
                }

            }

            if (Auth::user()->is_admin()) {
                return redirect(route('admin.dashboard'));

            } else {

                return redirect(route('main.index'));
            }

        }

        return redirect("login")->with([
            'basic' => "<b style='color:#c10b0b'><i>We are Sorry!</i></b><p>Unfortunately! Your Email, Phone Number <br>or Password Were Entered incorrectly!<br>Please, Try Again or Recover Password!</p><p><b><i>Best Regards!</i></b></p>"
        ]);
    }


    //Google login

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }

    // Google callback

    public function handleGoogleCallback()

    {

        $user = Socialite::driver('google')->user();


        $this->_registerOrLoginUser($user);


        // Return home after login

        return redirect()->route('main.index');

    }


    //Facebook login

    public function redirectToFacebook()

    {

        return Socialite::driver('facebook')->redirect();

    }

    // Facebook callback

    public function handleFacebookCallback()

    {

        $user = Socialite::driver('facebook')->user();


        $this->_registerOrLoginUser($user);


        // Return home after login

        return redirect()->route('main.index');

    }


    //Twitter login

    public function redirectToTwitter()

    {

        return Socialite::driver('twitter')->redirect();

    }

    // Twitter callback

    public function handleTwitterCallback()

    {

        $user = Socialite::driver('twitter')->user();


        $this->_registerOrLoginUser($user);


        // Return home after login

        return redirect()->route('main.index');

    }


    protected function _registerOrLoginUser($data)

    {

        $user = User::where('email', '=', $data->email)->first();


        if (!$user) {

            $user = new User();

            $user->name = $data->name;

            $user->email = $data->email;

            $user->provider_id = $data->id;

            $user->avatar = $data->avatar;

            $user->role = 3;

            $user->email_verified_at = now();

            $user->save();


            $full = $data->name;

            $full1 = explode(' ', $full);

            $first = $full1[0];

            $rest = ltrim($full, $first . ' ');


            $student = new Student();

            $student->user_id = $user->id;

            $student->first_name = $first;

            $student->last_name = $rest;

            $student->status = get_option('private_mode') ? STATUS_PENDING : STATUS_ACCEPTED;

            $student->save();

        } else {

            $student = $user->student;

        }


        if ($student->status != STATUS_PENDING) {

            Auth::login($user);

        }

    }


    public function forgetPassword()

    {

        $data = array();

        $data['title'] = __("Forget Password");

        return view('auth.forgot', $data);

    }

    public function generateVerificationPage($email)

    {

        if ($user = User::where('email', $email)->firstOrFail()) {

            $data['title'] = __("Generate Verification Code");
            $data['user'] = $user;

            return view('auth.generate-verification-page', $data);
        }

    }

    public function sendVerificationCode(Request $request)

    {
        $user = User::find($request->input('user-id'));

        $verification_code = $this->generateVerificationCode($user);

        try {

            if ($request->input('verify-by') === 'email') {
                Mail::to($user->email)->send(new ForgotPasswordMail($user, $verification_code));
            } else {

                // sms code here
//                $user->notify(new SnsNotification('Your verification code is : ' . $verification_code));
                $user->notify(new TwilioSmsNotification('Your LeoSystem Verification Code is: ' . $verification_code));
//                $sns = new SnsClient([
//                    'version' => 'latest',
//                    'region'  => env('AWS_DEFAULT_REGION'),
//                    'credentials' => [
//                        'key'    => env('AWS_ACCESS_KEY_ID'),
//                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
//                    ],
//                ]);
//
//                $args = array(
//                    'MessageAttributes' => [
//                        'AWS.SNS.SMS.SMSType' => [
//                            'DataType' => 'String',
//                            'StringValue' => 'Transactional'
//                        ]
//                    ],
//                    "Message" => "Welcome",
//                    "PhoneNumber" => "+923068097501"
//                );

            }

        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

        Session::put('email', $user->email);
        Session::put('verification_code', $verification_code);
        Session::put('verification_code_timestamp', now());
        $device = $request->input('verify-by') === 'email' ? 'Email' : 'Registered Phone Number';
        return redirect()->route('reset-password')->with([
            'basic' => "<b><i>Thank you for Password Recovery!</i></b><p>Your Secret Verification code for Password Recovery Was Successfully Sent to Your $device!<br>Please Go to Your $device!</p><br><b><i>Best Regards!</i></b>"
        ]);

    }

    public function showVerifyLogin()
    {
        $user = Auth::user();
        return view('auth.verify');
    }

    public function showVerifyLoginCode()
    {
        $user = Auth::user();
        return view('auth.verify-code', compact('user'));
    }

    public function sendLoginVerificationCode(Request $request)

    {
       
        try {
            if (!$request->wantsJson()) {
                $code = $request->input('captcha');
                if (md5($code) !== session('randomnr2')) {
                    return redirect()->back()->withErrors(['captcha' => "Invalid Captcha"]);
                }
            }
        } catch (ValidationException $e) {
            if ($request->wantsJson()) {
                return \response()->json([
                    'status' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors());
        }
 
        if (\auth()->check()) {
            $user = \auth()->user();
        } else {
            $user = User::find($request->input('user-id'));
        }
        $user_type = null;
        
        if ($user->role == USER_ROLE_ADMIN) {
            $user_type = "Admin";
        } else if ($user->role == USER_ROLE_STUDENT) {
            $user_type = "Student";
        } else if ($user->role == USER_ROLE_INSTRUCTOR) {
            $user_type = "Teacher";
        } else {
            $user_type = "Organization";
        }
        
        $verification_code = $this->generateVerificationCode($user);
//        return dd($request->input('verify-by'));
        $device = null;
       
        try {
            if ($request->input('verify-by') === 'email' || Session::get('verify-by') === 'email') {
               //Temp commented the line below, uncomment it when done
                 Mail::to($user->email)->send(new LoginVerification($user, $verification_code, $user_type));
                $device = "Email";
                Session::put('verify-by', 'email');
            } else {
                
                $user->notify(new TwilioSmsNotification('Your LeoSystem Verification Code is: ' . $verification_code));
                
                $device = "Registered Phone Number";
                Session::put('verify-by', 'phone');
            }

        } catch (\Exception $exception) {
            if ($request->wantsJson()) {
                return \response()->json([
                    'status' => true,
                    'message' => $exception->getMessage()
                ]);
            }
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

        Session::put('verification_code', $verification_code);
        Session::put('verification_code_timestamp', now());
        Session::put('verify-by', $request->input('verify-by'));
        if ($request->wantsJson()) {
            return \response()->json([
                'status' => true,
                'message' => "<b><i>Thank you for Verifying!</i></b><p>Your Verification code for Login Was Successfully Sent to Your $device!<br>Please Go to Your $device!</p><br><b><i>Best Regards!</i></b>"
            ]);
        }
        return redirect()->route('verify.login.code')->with([
            'basic' => "<b><i>Thank you for Verifying!</i></b><p>Your Verification code for Login Was Successfully Sent to Your $device!<br>Please Go to Your $device!</p><br><b><i>Best Regards!</i></b>"
        ]);

    }

    public function verifyLogin(Request $request)
    {
       

        if ($request->wantsJson()) {
            $code = $request->input('captcha');
            if (md5($code) !== session('randomnr2')) {
                return \response()->json([
                    'status' => false,
                    'error' => "<b class='text-danger'>Unfortunately, You Entered an Incorrect CAPTCHA!</b><p>Please, Update the CAPTCHA Try Again!</p><b><i>Best Regards!</i></b>"
                ], 422);
            }
        }

        // Check if the stored timestamp is older than 30 minutes
        if (Carbon::parse(session('verification_code_timestamp'))->addMinutes(30)->isPast()) {
            if ($request->wantsJson()) {
                return \response()->json([
                    'status' => false,
                    'error' => "<b class='text-danger'><i>Your Verification Code Has Expired!</i></b><p>Please, Receive Verification Code Again!</p><br><b><i>Best Regards!</i></b>"
                ], 400);
            } else {
                return redirect()->route('verify.login.code')->with(['error' => "<b class='text-danger'><i>Your Verification Code Has Expired!</i></b><p>Please, Receive Verification Code Again!</p><br><b><i>Best Regards!</i></b>"]);
            }
        }

        try {
           if ($request->input('verification_code') == session('verification_code')) {
            //Temp Added    
           // if ($request->input('verification_code') == 123456) {
                session(['verified' => true]);
                if ($request->wantsJson()) {
                    return \response()->json([
                        'status' => true,
                        'message' => "<b><i>Thank you for Verifying!</i></b><p>Successfully Verified. Redirecting...</p><br><b><i>Best Regards!</i></b>"
                    ]);
                } else {
                    return redirect()->route('main.index');
                }
            }
            if ($request->wantsJson()) {
                return \response()->json([
                    'status' => false,
                    'message' => "<b class='text-danger'>Your Verification Code is InCorrect!</b><p>Please, Check the Correctness of the Entered <br>Verification Code and Try Again!</p><b>Best Regards!</b>"
                ]);
            } else {
                return redirect()->route('verify.login.code')->with(['error' => '<b class="text-danger">Your Verification Code is InCorrect!</b><p>Please, Check the Correctness of the Entered <br>Verification Code and Try Again!</p><b>Best Regards!</b>']);
            }
        } catch (\Exception $exception) {
            if ($request->wantsJson()) {
                return \response()->json($exception->getMessage());
            }
            return redirect()->route('verify.login.code')->with(['error' => $exception->getMessage()]);
        }
    }

    public function forgetPasswordEmail(Request $request)

    {

        $email = $request->email;

        $user = User::whereEmail($email)->first();

        if ($user) {
            return redirect()->route('generate-verification-page', ['email' => $user->email]);
        }

        return redirect()->back()->with(['error' => 'Your Email is incorrect!']);
    }


    public function resetPassword()

    {

        $data['title'] = __("Reset Password");
        return view('auth.reset-password', $data);

    }


    public function resetPasswordCheck(Request $request)

    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $email = Session::get('email');
        $verification_code = Session::get('verification_code');

        if ($request->verification_code == $verification_code) {

            $user = User::whereEmail($email)->whereForgotToken($verification_code)->first();

            if (!$user) {
                return redirect()->back()->with(['error' => 'Your verification code is incorrect!']);
            } else {

                $request->validate([
                    'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6'
                ]);

                $user->password = Hash::make($request->password);
                $user->email_verified_at = now();
                $user->forgot_token = null;
                $user->save();

                Session::put('email', '');
                Session::put('verification_code', '');

                return redirect()->route('login')->with(['basic' => "<b><i>Thank you for Changing Your Password!</i></b><p class='text-success'>Your Password Has Been Changed Successfully</p><br><b><i>Best Regards!</i></b>"]);
            }
        } else {
            return redirect()->back()->with(['error' => 'Your verification code is incorrect!']);
        }
    }


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function logout(Request $request)

    {
        //remove device tracking session
        if (get_option('device_control')) {
            $device_uuid = $request->cookie('_uuid_d');
            Cookie::queue(Cookie::forget('_uuid_d'));
            Device::join('device_user', 'devices.id', '=', 'device_user.device_id')->where('devices.device_uuid', $device_uuid)->update(['deleted_at' => now()]);
        }

        $this->guard()->logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        if ($response = $this->loggedOut($request)) {

            return $response;

        }


        return $request->wantsJson()

            ? new JsonResponse([], 204)

            : redirect('/');

    }

    /**
     * @param $user
     * @return int
     */
    protected function generateVerificationCode($user): int
    {
        $verification_code = rand(100000, 999999);
        if ($verification_code) {
            $user->forgot_token = $verification_code;
            $user->save();
        }
        return $verification_code;
    }

}

