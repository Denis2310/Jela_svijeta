<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class nullOrNotNull implements Rule
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
        return (($value === 'null') || ($value === '!null') || is_int($value)); 
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'With or Without category field can only be strings null and !null.';
    }
}
