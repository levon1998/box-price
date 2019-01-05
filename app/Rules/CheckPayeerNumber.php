<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPayeerNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Неверный формат';
    }
}
