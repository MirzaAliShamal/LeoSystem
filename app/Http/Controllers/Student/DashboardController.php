<?php


namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;

use App\Http\Requests\Student\ProfileRequest;

use App\Models\City;

use App\Models\Country;

use App\Models\Enrollment;

use App\Models\Instructor;

use App\Models\InstructorFeature;

use App\Models\InstructorProcedure;

use App\Models\Organization;

use App\Models\State;

use App\Models\Student;

use App\Models\User;

use App\Rules\EnglishName;
use App\Tools\Repositories\Crud;

use App\Traits\General;

use App\Traits\ImageSaveTrait;

use App\Traits\SendNotification;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;


class DashboardController extends Controller
{


    use ImageSaveTrait, General, SendNotification;


    protected $studentModel;

    protected $organizationModel;

    protected $instructorModel;


    public function __construct(Student $student, Instructor $instructor, Organization $organization)
    {

        $this->studentModel = new Crud($student);

        $this->instructorModel = new Crud($instructor);

        $this->organizationModel = new Crud($organization);

    }


    public function dashboard()
    {

        return redirect(route('student.profile'));

    }


    public function profile()
    {
       // return phpinfo();
        $data['pageTitle'] = "Profile";

        $data['user'] = auth::user();

        $data['student'] = $data['user']->student;

        return view('frontend.student.settings.profile', $data);

    }


    public function address()
    {

        $data['pageTitle'] = "Address";

        $data['user'] = auth::user();

        $data['student'] = $data['user']->student;

        $data['countries'] = Country::orderBy('country_name', 'asc')->get();

        if (old('country_id')) {

            $data['states'] = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();

        }

        if (old('state_id')) {

            $data['cities'] = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();

        }

        return view('frontend.student.settings.address', $data);

    }


    public function address_update(Request $request, $uuid)
    {

        $request->validate([

            'country_id' => 'required',

            'state_id' => 'required',

            'city_id' => 'required',

            'postal_code' => 'required',

            'address' => 'required',

            'lat' => 'required',

            'long' => 'required',

        ]);


        $student = $this->studentModel->getRecordByUuid($uuid);

        $user = User::find($student->user_id);

        $user->lat = $request->lat;

        $user->long = $request->long;

        $user->save();


        $data = [

            'country_id' => $request->country_id,

            'state_id' => $request->state_id,

            'city_id' => $request->city_id,

            'postal_code' => $request->postal_code,

            'address' => $request->address,

        ];


        $this->studentModel->updateByUuid($data, $uuid);

        $this->showToastrMessage('success', __('Successfully Updated!'));

        return redirect()->back();

    }


    public function changePassword()
    {

        $data['pageTitle'] = "Change Password";

        $data['user'] = auth::user();


        return view('frontend.student.settings.change-password', $data);

    }


    public function changePasswordUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'old_password' => 'required',

            'new_password' => 'required'

        ]);


        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();

        }


        $user = User::find(Auth::id());


        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->new_password);

            $user->save();

            $this->showToastrMessage('success', __('Password changed successfully'));

            return redirect()->back();

        } else {

            $this->showToastrMessage('error', __('Your old password does not match.'));

            return redirect()->back();

        }

    }


    public function becomeAnInstructor()
    {

        if (auth()->user()->role == USER_ROLE_INSTRUCTOR) {

            $this->showToastrMessage('error', __('You are already an instructor!'));

            return redirect()->back();

        } elseif (auth()->user()->role == USER_ROLE_ORGANIZATION) {

            $this->showToastrMessage('error', __('You are already an organization!'));

            return redirect()->back();

        }


        $data['pageTitle'] = 'Become a Partner';

        $data['instructorFeatures'] = InstructorFeature::take(3)->get();

        $data['instructorProcedures'] = InstructorProcedure::all();

        $data['total_students'] = Student::count();

        $data['total_enrollments'] = Enrollment::count();

        $data['total_instructors'] = Instructor::count();


        return view('frontend.student.settings.become-an-instructor', $data);

    }
    public function showInstructorInfoForm()
    {
        return view('frontend.student.settings.instructor-info');
    }


    public function saveInstructorInfo(Request $request)
    {
        $req = "";
        if ($request->account_type == 4) {
            $req = "required";
            $request->validate(['full_organization_name_en' => [$req,new EnglishName()]]);
        }

        if($request->account_type == USER_ROLE_INSTRUCTOR){
            $request->validate([
                'first_name_en' => ['required',new EnglishName()],
                'last_name_en' => ['required',new EnglishName()],
            ]);
        }

        $request->validate(
            [

                'first_name' => $req,

                'account_type' => 'required',

                'full_organization_name' => $req,

                'official_id_number' => $req,

                'number_of_teachers' => $req,

                'last_name' => 'required',

                'professional_title' => 'required',

                'about_me' => 'required',

                'cv_file' => 'required|max:5000|mimes:pdf',

            ],

            [

                'required' => 'The :attribute field is required.',

            ]
        );

        $authUser = Auth::user();


        if ($request->account_type == USER_ROLE_ORGANIZATION) {

            $object = Organization::where('user_id', $authUser->id)->get();

        } else {

            $object = Instructor::where('user_id', $authUser->id)->get();

        }


        if ($object->count() > 0) {

            $this->showToastrMessage('success', __('Request already send'));

            return redirect(route('student.dashboard'));

        } else {


            if ($request->account_type == USER_ROLE_ORGANIZATION) {

                $slugCount = Organization::where('slug', getSlug($authUser->name))->count();

            } else {

                $slugCount = Instructor::where('slug', getSlug($authUser->name))->count();

            }


            if ($slugCount) {

                $slug = getSlug($authUser->name) . '-' . rand(100000, 999999);

            } else {

                $slug = getSlug($authUser->name);

            }


            $cv_file_data = $this->uploadFileWithDetails(Auth::user()->id . '/user', $request->cv_file);

            if (!$cv_file_data['is_uploaded']) {

                $this->showToastrMessage('error', __('Something went wrong! Failed to upload file'));

                return redirect()->back();

            }

            $data = [

                'user_id' => Auth::user()->id,

                'first_name' => $request->first_name,

                'last_name' => $request->last_name,

                'first_name_en' => $request->first_name_en,

                'last_name_en' => $request->last_name_en,

                'middle_name_en' => $request->middle_name_en,

                'professional_title' => $request->professional_title,

                'phone_number' => $request->phone_number,

                'native_speaker' => $request->native_speaker,

                'address' => $request->address,

                'about_me' => $request->about_me,

                'slug' => $slug,

                'cv_file' => $cv_file_data['path'],

                'cv_filename' => $cv_file_data['original_filename'],

            ];

            if ($request->account_type == USER_ROLE_ORGANIZATION) {
                $data['full_organization_name'] = $request->full_organization_name;
                $data['full_organization_name_en'] = $request->full_organization_name_en;
                $data['official_id_number'] = $request->official_id_number;
                $data['number_of_teachers'] = $request->number_of_teachers;
                $data['native_speaker'] = $request->native_speaker;

                $this->organizationModel->create($data);
                $text = __("New organization request");

                $target_url = route('organizations.pending');

                $this->send($text, 1, $target_url, null);
                return redirect(route('student.profile'))->with([
                    'success' => "<b><i  style='font-weight: bold; color: #000000;'>Thank you for Your Application to Become a Organization!</i></b><p style='font-weight: bold; color: #006400;'>We Will Definitely Consider Your Application!</p><br><p style='color:black;font-size:19px;'>Please, Wait for Information To Your Email!</p><br><b><i style='color:black;font-weight: bold;'>Best Regards!</i></b>"
                ]);

            } else {

                $this->instructorModel->create($data);

                $text = __("New instructor request");

                $target_url = route('instructor.pending');

                $this->send($text, 1, $target_url, null);
                return redirect(route('student.profile'))->with([
                    'success' => "<b><i  style='font-weight: bold; color: #000000;'>Thank you for Your Application to Become a Teacher!</i></b><p style='font-weight: bold; color: #006400;'>We Will Definitely Consider Your Application!</p><br><p style='color:black;font-size:19px;'>Please, Wait for Information To Your Email!</p><br><b><i style='color:black;font-weight: bold;'>Best Regards!</i></b>"
                ]);

            }








            // return redirect()->route('verify.login.code')

        }


    }


    public function saveProfile(ProfileRequest $request, $uuid)
    {

        $student = $this->studentModel->getRecordByUuid($uuid);


        $user = User::find($student->user_id);

        if (User::where('id', '!=', $user->id)->where('email', $request->email)->count() > 0) {

            $this->showToastrMessage('warning', __('Email already exist'));

            return redirect()->back();

        } else {

            $user->email = $request->email;

        }

        // if ($request->image)

        // {

        //     $this->deleteFile($user->image); // delete file from server


        //     // $image = $this->saveImage(Auth::user()->id.'/user', $request->image, null, 'null'); // new file upload into server
        //     $image = $this->uploadFileWithDetails(Auth::user()->id.'/user', $request->image);
        //     $image = $image['path'];


        // } else {

        //     $image = $user->image;

        // }

        if ($request->image_base64) {
            $this->deleteFile($user->image); // delete file from server

            $image = $this->storeBase64($request->image_base64, Auth::user()->id . '/user');
            //  dd($image);
            if ($image) {
                $user->image = $image;
            } else {
                // Handle the case where storing the base64 image failed
                // You can add a message or redirect back with an error
                return back()->with('error', 'Failed to store image.');
            }
        }


        $user->name = $request->first_name . ' ' . $request->last_name;

        $user->area_code = $request->area_code;
        $user->mobile_number = $request->phone_number;
        $user->save();


        $student_data = [

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'phone_number' => $request->phone_number,

            'about_me' => $request->about_me,

            'gender' => $request->gender

        ];


        $student = $this->studentModel->updateByUuid($student_data, $uuid); // update category


        $this->showToastrMessage('success', __('Successfully save'));

        return redirect()->back();

    }

    public function saveAvatar(Request $request, $uuid)
    {
        $student = $this->studentModel->getRecordByUuid($uuid);

        //        if(\auth()->user()->role === USER_ROLE_INSTRUCTOR || \auth()->user()->role === USER_ROLE_ORGANIZATION)
//        {
        
        $this->deleteFile($student->image); // delete file from server

        $image = $this->saveImageFromBase64(Auth::user()->id . '/user', $request->image_base64, 700, 700); // new file upload into server
        if ($image) {
            $student->image = $image;
        } else {
            return back()->with('error', 'Failed to store image.');
        }
        $student->image = $image;
        $student->save();

        $this->showToastrMessage('success', __('Profile successfully uploaded'));
        return redirect()->back();
        //        }
//        $user = User::find($student->user_id);
//        if ($request->image_base64) {
//            $this->deleteFile($user->image); // delete file from server
//
//            $image = $this->saveImageFromBase64(Auth::user()->id.'/user', $request->image_base64,700,700); // new file upload into server
//            if ($image) {
//                $user->image = $image;
//            } else {
//                return back()->with('error', 'Failed to store image.');
//            }
//            $user->image = $image;
//            $user->save();
//
//            $this->showToastrMessage('success', __('Profile successfully uploaded'));
//            return redirect()->back();
//        }
        return redirect()->back();
    }

    private function storeBase64($imageBase64, $folderName = 'user')
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64) = explode(',', $imageBase64);

        $imageBase64 = base64_decode($imageBase64);
        $imageName = time() . '-' . Str::random(10) . '.jpg';

        $userDirectory = public_path("uploads/{$folderName}");

        // Create the user directory if it doesn't exist
        if (!is_dir($userDirectory)) {
            mkdir($userDirectory, 0755, true);
        }

        $path = $userDirectory . '/' . $imageName;

        // Debugging: Check the values


        file_put_contents($path, $imageBase64);

        return $imageName;
    }


    public function getStateByCountry($country_id)
    {

        return State::where('country_id', $country_id)->orderBy('name', 'asc')->get()->toJson();

    }


    public function getCityByState($state_id)
    {

        return City::where('state_id', $state_id)->orderBy('name', 'asc')->get()->toJson();

    }


}
