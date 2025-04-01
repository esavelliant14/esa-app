<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required', 
            'string', 
            'min:8', 
            'regex:/[a-z]/', // minimum 1 lowercase
            'regex:/[A-Z]/', // minimum 1 uppercase
            'regex:/[^a-zA-Z\d]/', // minimum 1 specialchar
            'regex:/\d/', // minimum 1 integer
            'confirmed'
        ];
    }
}
