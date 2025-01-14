<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

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
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone_number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string'],
            // 'image' => 'mimes:jpeg,png,jpg|file|dimensions:min_width=600,min_height=600,max_width=600,max_height=600|max:1024'
        ];
    }
}
