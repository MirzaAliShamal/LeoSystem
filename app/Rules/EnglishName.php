<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnglishName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the value contains only English letters and spaces
        return preg_match('/^[A-Za-z\s]+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value must be in English letters only.';
    }
}
