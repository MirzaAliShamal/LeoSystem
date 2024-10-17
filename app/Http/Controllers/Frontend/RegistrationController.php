<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;

use App\Http\Requests\Frontend\SignUpRequest;

use App\Mail\UserApprovedMail;
use App\Mail\UserEnailVerificaion;

use App\Models\Country;

use App\Models\Instructor;

use App\Models\Student;

use App\Models\User;

use App\Tools\Repositories\Crud;

use App\Traits\EmailSendTrait;

use App\Traits\ImageSaveTrait;

use App\Traits\General;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

use File;
use Mockery\Exception;


class RegistrationController extends Controller

{
    use EmailSendTrait, ImageSaveTrait, General;


    protected $model;

    protected $studentModel;


    public function __construct(User $user, Student $student)

    {

        $this->model = new Crud($user);

        $this->studentModel = new Crud($student);

    }


    public function signUp()

    {

        $data['pageTitle'] = __('Sign Up');

        $data['title'] = __('Sign Up');

        $data['countries'] = Country::all();

        return view('auth.sign-up', $data);

    }


    public function storeSignUp(SignUpRequest $request)

    {

        $user = new User();

        $user->name = $request->first_name . ' ' . $request->last_name;

        $user->email = $request->email;

        $user->area_code = $request->area_code;

        $user->mobile_number = $request->mobile_number;

        $user->phone_number = $request->mobile_number;

        $user->password = Hash::make($request->password);

        $user->remember_token = $request->_token;

        $user->email_verified_at = get_option('registration_email_verification') == 1 ? NULL : now();

        $user->role = 3;

        $user->save();

        $student_data = [

            'user_id' => $user->id,

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'phone_number' => $user->phone_number,

            'status' => get_option('private_mode') ? STATUS_PENDING : STATUS_ACCEPTED

        ];

        $path_assignment = public_path() . '/uploads/' . $user->id . '/assignment/';
        File::makeDirectory($path_assignment, $mode = 0777, true, true);

        $path_bundle = public_path() . '/uploads/' . $user->id . '/bundle/';
        File::makeDirectory($path_bundle, $mode = 0777, true, true);

        $path_certificate_student = public_path() . '/uploads/' . $user->id . '/certificate/student/';
        File::makeDirectory($path_certificate_student, $mode = 0777, true, true);

        $path_course = public_path() . '/uploads/' . $user->id . '/course/';
        File::makeDirectory($path_course, $mode = 0777, true, true);

        $path_course_resource = public_path() . '/uploads/' . $user->id . '/course_resource/';
        File::makeDirectory($path_course_resource, $mode = 0777, true, true);

        $path_lecture = public_path() . '/uploads/' . $user->id . '/lecture/';
        File::makeDirectory($path_lecture, $mode = 0777, true, true);

        $path_user = public_path() . '/uploads/' . $user->id . '/user/';
        File::makeDirectory($path_user, $mode = 0777, true, true);

        $path_video = public_path() . '/uploads/' . $user->id . '/video/';
        File::makeDirectory($path_video, $mode = 0777, true, true);

        $path_scorm = public_path() . '/uploads/' . $user->id . '/scorm/';
        File::makeDirectory($path_scorm, $mode = 0777, true, true);


        $this->studentModel->create($student_data);


        if (get_option('registration_system_bonus_mode', 0)) {

            $balance = get_option('registration_bonus_amount');

            $user->increment('balance', decimal_to_int($balance));

            createTransaction($user->id, $balance, TRANSACTION_REGISTRATION_BONUS, 'Registration Bonus');

        }


        if (get_option('registration_email_verification') == 1) {

            try {

                Mail::to($user->email)->send(new UserEnailVerificaion($user));

            } catch (\Exception $exception) {

                return redirect()->back()->with(['error' => 'Something is wrong. Try after few minutes!']);

            }
            return redirect(route('login'))->with(['success' => '<b>Thank you for Registration!<b><p>A Confirmation Letter has Been Sent to Your Email Address!</p><p>Please, Go to Your Email and Confirm Your Email!</p> <b>Best Regards!</b>']);

        }

        return redirect(route('login'))->with(['success' => __('Your registration is successful.')]);

    }


    public function emailVerification($token)

    {
        try {

            if (User::where('remember_token', $token)->count() > 0) {

                $user = User::where('remember_token', $token)->first();

                $user->email_verified_at = Carbon::now()->format("Y-m-d H:i:s");

                $user->remember_token = null;

                $user->save();

//                if (!$user->student || ($user->student && $user->student->status != STATUS_PENDING)) {
//                    session(['success' => 'Congratulations! Successfully verified your email.']);
//                }
                Mail::to($user->email)->send(new UserApprovedMail($user,'LS'.$user->id.'ST','Student','Congratulations! You are Successfully Registered!'));
                return redirect(route('login'))->with(['success' => "<b class='text-success'><i>Your Email Has Been Successfully verified.</i></b><p>Please, Enter Email or Phone Number and Password to Login!</p><br><b><i>Best Regards!</i></b>"]);

            } else {
                return redirect(route('login'))->with(['success' => "<b class='text-danger'><i>Your Email Verification Link Has Expired!</i><b><p>Please, Go Through the Registration Process Again!</p><br><b><i>Best Regards!</i></b>"]);
            }

        } catch (Exception  $e) {
            return redirect(route('login'))->with(['error' => $e->getMessage()]);
        }


    }


}

