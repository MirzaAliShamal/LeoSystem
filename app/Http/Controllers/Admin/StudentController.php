<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Mail\UserApprovedMail;
use App\Mail\UserBlockedMail;
use App\Mail\UserRejectedMail;
use App\Models\BlockingHistory;
use App\Models\City;

use App\Models\Country;

use App\Models\Enrollment;

use App\Models\Instructor;

use App\Models\Order;

use App\Models\Order_item;

use App\Models\State;

use App\Models\Student;

use App\Models\User;

use App\Tools\Repositories\Crud;

use App\Traits\General;

use App\Traits\ImageSaveTrait;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mockery\Exception;


class StudentController extends Controller

{

    use General, ImageSaveTrait;



    protected $studentModel;
    protected $blockingHistoryModel;

    public function __construct( Student $student,BlockingHistory $blockingHistory)

    {

        $this->studentModel = new Crud($student);
        $this->blockingHistoryModel = new Crud($blockingHistory);

    }

    public function index()

    {

        $data['title'] = 'All Student';

        $data['students'] = $this->studentModel->getOrderById('DESC', 25);

        return view('admin.student.list', $data);

    }


    public function blocking_history()

    {
        // will be done with permission later
        $data['title'] = __('Students Blocking History');

        $data['blocked_students'] = BlockingHistory::orderBy('id', 'DESC')->students()->paginate(25);

        return view('admin.student.blocking_history', $data);

    }



    public function pending_list()

    {

        $data['title'] = 'Pending Student';

        $data['students'] = Student::where('status', STATUS_PENDING)->orderBy('id', 'DESC')->paginate(25);

        return view('admin.student.pending_list', $data);

    }



    public function create()

    {

        $data['title'] = 'Add Student';

        $data['countries'] = Country::orderBy('country_name', 'asc')->get();



        if (old('country_id')) {

            $data['states'] = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();

        }



        if (old('state_id')) {

            $data['cities'] = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();

        }

        return view('admin.student.add', $data);

    }



    public function store(Request $request)

    {

        $request->validate([

            'first_name' => ['required', 'string', 'max:100'],

            'last_name' => ['required', 'string', 'max:100'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => ['required', 'string', 'min:2'],

            'area_code' => 'required',

            'phone_number' => 'bail|numeric|unique:users,mobile_number',

            'address' => 'required',

            'gender' => 'required',

            'about_me' => 'required',
            'image_base64' => 'required',

            'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=300,min_height=300,max_width=300,max_height=300|max:1024'

        ]);



        $user = new User();

        $user->name = $request->first_name . ' '. $request->last_name;

        $user->email = $request->email;

        $user->area_code =  $request->area_code;

        $user->mobile_number = $request->phone_number;

        $user->phone_number =  $request->phone_number;

        $user->email_verified_at = now();

        $user->password = Hash::make($request->password);

        $user->role = 3;

        $user->image =  $request->image ? $this->saveImage('user', $request->image, null, null) :   null;
//  $user->image = $this->storeBase64($request->image_base64);
        $user->save();



        $student_data = [

            'user_id' => $user->id,

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'address' => $request->address,

            'phone_number' =>  $request->phone_number,

            'country_id' => $request->country_id,

            'state_id' => $request->state_id,

            'city_id' => $request->city_id,

            'gender' => $request->gender,

            'about_me' => $request->about_me,

            'postal_code' => $request->postal_code,

        ];



        $this->studentModel->create($student_data);



        $this->showToastrMessage('success', __('Student created successfully'));

        return redirect()->route('student.index');

    }



    public function view($uuid)

    {

        $data['title'] = 'Student Profile';

        $data['student'] = $this->studentModel->getRecordByUuid($uuid);

        $data['enrollments'] = Enrollment::where('user_id', $data['student']->user_id)->whereNotNull('course_id')->latest()->paginate(15);



        return view('admin.student.view', $data);

    }



    public function edit($uuid)

    {

        $data['title'] = 'Edit Student';

        $data['student'] = $this->studentModel->getRecordByUuid($uuid);

        $data['user'] = User::findOrfail($data['student']->user_id);



        $data['countries'] = Country::orderBy('country_name', 'asc')->get();



        if (old('country_id'))

        {

            $data['states'] = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();

        }



        if (old('state_id'))

        {

            $data['cities'] = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();

        }



        return view('admin.student.edit', $data);

    }



    public function update(Request $request, $uuid)

    {

        $student = $this->studentModel->getRecordByUuid($uuid);



        $request->validate([

            'first_name' => ['required', 'string', 'max:100'],

            'last_name' => ['required', 'string', 'max:100'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$student->user_id],

            'area_code' => 'required',

            'phone_number' => 'bail|numeric|unique:users,mobile_number,'.$student->user_id,

            'address' => 'required',

            'gender' => 'required',

            'about_me' => 'required',

            'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=300,min_height=300,max_width=300,max_height=300|max:1024'

        ]);





        $user = User::findOrfail($student->user_id);

        if (User::where('id', '!=', $student->user_id)->where('email', $request->email)->count() > 0) {

            $this->showToastrMessage('warning', __('Email already exist'));

            return redirect()->back();

        }



        $user->name = $request->first_name . ' '. $request->last_name;

        $user->email = $request->email;

        if ($request->password){

            $request->validate([

                'password' => 'required|string|min:6'

            ]);

            $user->password = Hash::make($request->password);

        }

        $user->area_code =  $request->area_code;

        $user->mobile_number = $request->phone_number;

        $user->phone_number = $request->phone_number;

        $user->image =  $request->image ? $this->saveImage('user', $request->image, null, null) :   $user->image;

        $user->save();



        $student_data = [

            'user_id' => $user->id,

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'address' => $request->address,

            'phone_number' => $request->phone_number,

            'country_id' => $request->country_id,

            'state_id' => $request->state_id,

            'city_id' => $request->city_id,

            'gender' => $request->gender,

            'about_me' => $request->about_me,

            'postal_code' => $request->postal_code,

        ];



        $this->studentModel->updateByUuid($student_data, $uuid);



        $this->showToastrMessage('success', __('Updated Successfully'));

        return redirect()->route('student.index');

    }



    public function delete($uuid)

    {

        $student = $this->studentModel->getRecordByUuid($uuid);

        $instructor = Instructor::whereUserId($student->user_id)->first();

        if ($instructor){

            $this->showToastrMessage('error', __('You can`t delete it. Because this user already an instructor. If you want to delete, at first you delete from instructor.'));

            return redirect()->back();

        }

        if ($student){

            $this->deleteFile(@$student->user->image);

        }

        User::find($student->user_id)->delete();

        $this->studentModel->deleteByUuid($uuid);

        Mail::to($student->user->email)->send(new UserRejectedMail($student->user,$student->status_message,'Student'));

        $this->showToastrMessage('success', __('Deleted Successfully'));

        return redirect()->back();

    }



    public function changeStudentStatus(Request $request)

    {

        try {

            $student = Student::findOrFail($request->id);
            $student->status = $request->status;
            $student->status_message = $request->status_message;

            switch ($student->status){
                case STATUS_APPROVED:
                    $this->blockingHistoryModel->create([
                        'manage_user' => auth()->id(),
                        'user' => $student->user->id,
                        'message' => $request->input('status_message'),
                        'type'    => USER_ROLE_STUDENT,
                        'status'  => STATUS_APPROVED,
                    ]);
                    Mail::to($student->user->email)->send(new UserApprovedMail($student->user,'LS'.$student->user->id.'ST','Student','Congratulations! Your Student Account has been Unblocked Successfully!','Student Account Unblocked'));
                    $student->save();
                    break;
                case STATUS_REJECTED:
                     $this->blockingHistoryModel->create([
                         'manage_user' => auth()->id(),
                         'user' => $student->user->id,
                         'message' => $request->input('status_message'),
                         'type'    => USER_ROLE_STUDENT,
                         'status'  => STATUS_REJECTED,
                     ]);
                     Mail::to($student->user->email)->send(new UserBlockedMail($student->user,$student->status_message,'Student'));
                     $student->save();
                     break;
                default: return response()->json([ 'data' => 'error' ]);
            }

            return response()->json([
                'data' => 'success',
            ]);
        }catch (Exception $e){
            return response()->json([
                'data' => $e->getMessage(),
            ]);
        }

    }



    public function changeEnrollmentStatus(Request $request)

    {

        $enrollment = Enrollment::findOrFail($request->id);

        $enrollment->status = $request->status;

        $enrollment->save();



        return response()->json([

            'data' => 'success',

        ]);

    }

}

