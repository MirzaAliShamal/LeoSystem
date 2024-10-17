<?php

namespace App\Http\Requests\Instructor;

use App\Rules\EnglishName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'first_name' => ['required', 'string', 'max:100'],
//            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=600,min_height=600,max_width=600,max_height=600|max:1024'
        ];
    }
}
