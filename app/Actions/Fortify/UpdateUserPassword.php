<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'password_saat_ini' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->mixedCase()->uncompromised(), 'confirmed'],
        ], [
            'password_saat_ini.current_password' => __('Password yang diberikan tidak sesuai dengan password saat ini.'),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
