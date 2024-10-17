<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\ProfileRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Instructor;
use App\Models\Instructor_awards;
use App\Models\Instructor_certificate;
use App\Models\Skill;
use App\Models\State;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PharIo\Manifest\Exception;

class ProfileController extends Controller
{
    use  ImageSaveTrait, General;

    protected $model;
    protected $userModel;

    public function __construct(Instructor $instructor, User $user)
    {
        $this->model = new Crud($instructor);
        $this->userModel = new Crud($user);
    }

    public function profile()
    {
        $data['title'] = 'Instructor Profile';
        $data['navProfileActiveClass'] = 'has-open';
        $data['subNavProfileBasicActiveClass'] = 'active';
        $data['user'] = Auth::user();
        $data['instructor'] = Auth::user()->instructor;
        $data['skills'] = Skill::where('status', 1)->get();
        return view('instructor.profile', $data);
    }

    public function saveProfileImage(Request $request, $uuid)
    {
        try {
            $instructor = $this->model->getRecordByUuid($uuid);
            $user = User::find($instructor->user_id);
            if ($user) {
                $this->deleteFile($user->image); // delete file from server
                $image = $this->saveImageFromBase64(Auth::user()->id.'/user', $request->image_base64,700,700); // new file upload into server

//                $image = $this->storeBase64($request->image_base64, Auth::user()->id . '/user');
                if ($image) {
                    $user->image = $image;
                    $user->save();
                } else {
                    $this->showToastrMessage('warning', 'Failed to store image');
                    return response()->json('error', 400);
                }
            }else {
                $this->showToastrMessage('warning', __('Instructor not found'));
                return response()->json('error', 404);
            }
        } catch (Exception $e) {
            $this->showToastrMessage('error', $e->getMessage());
            return response()->json('error', 400);
        }
    }

    public function saveProfile(ProfileRequest $request, $uuid)
    {
        $instructor = $this->model->getRecordByUuid($uuid);

        $user = User::find($instructor->user_id);
        if (User::where('id', '!=', $user->id)->where('email', $request->email)->count() > 0) {
            $this->showToastrMessage('warning', __('Email already exist'));
            return redirect()->back();
        } else {
            $user->email = $request->email;
        }

        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->save();

        $instructor_date = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'professional_title' => $request->professional_title,
            'native_speaker' => $request->native_speaker,
            'phone_number' => $request->phone_number,
            'about_me' => $request->about_me,
            'social_link' => json_encode($request->social_link),
            'gender' => $request->gender,
        ];

        $instructor = $this->model->updateByUuid($instructor_date, $uuid); // update category

        $instructor->skills()->sync($request->skills); // Skills

        /**
         * manage instructor certificate
         */

        $certificate_title = $request->certificate_title;
        $certificate_date = $request->certificate_date;
        if ($certificate_title && $certificate_date) {
            Instructor_certificate::where('instructor_id', $instructor->id)->delete();
            for ($c = 0; $c < count($certificate_title); $c++) {
                if ($certificate_title[$c] != '' && $certificate_date[$c] != '') {
                    $certificate = [
                        'instructor_id' => $instructor->id,
                        'name' => $certificate_title[$c],
                        'passing_year' => $certificate_date[$c]
                    ];
                    Instructor_certificate::create($certificate);
                }
            }
        }

        /**
         * end manage instructor certificate
         */

        /**
         * manage instructor award
         */

        $award_title = $request->award_title;
        $award_year = $request->award_year;
        if ($award_title && $award_year) {
            Instructor_awards::where('instructor_id', $instructor->id)->delete();
            for ($a = 0; $a < count($award_title); $a++) {
                if ($award_title[$a] != '' && $award_year[$a] != '') {
                    $award = [
                        'instructor_id' => $instructor->id,
                        'name' => $award_title[$a],
                        'winning_year' => $award_year[$a]
                    ];
                    Instructor_awards::create($award);
                }
            }
        }

        /**
         * end instructor award
         */


        $this->showToastrMessage('success', __('Successfully save'));
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

    public function address()
    {
        $data['title'] = 'Instructor Address';
        $data['navProfileActiveClass'] = 'has-open';
        $data['subNavProfileAddressActiveClass'] = 'active';
        $data['instructor'] = Auth::user()->instructor;
        $data['user'] = Auth::user();
        $data['countries'] = Country::orderBy('country_name', 'asc')->get();
        if (old('country_id')) {
            $data['states'] = State::where('country_id', old('country_id'))->orderBy('name', 'asc')->get();
        }
        if (old('state_id')) {
            $data['cities'] = City::where('state_id', old('state_id'))->orderBy('name', 'asc')->get();
        }
        return view('instructor.address', $data);
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
        $instructor = $this->model->getRecordByUuid($uuid);
        $user = User::find($instructor->user_id);
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

        $this->model->updateByUuid($data, $uuid);
        $this->showToastrMessage('success', __('Successfully Updated!'));
        return redirect()->back();
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
