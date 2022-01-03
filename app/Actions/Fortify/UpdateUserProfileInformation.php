<?php

namespace App\Actions\Fortify;

use Deligoez\TCKimlikNo\Rules\TCKimlikNoVerify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use TCKimlikNo;

/**
 * User Profile Update Classes (not used)
 * @deprecated
 */
class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'tc_kn' => ['bail','required',new TCKimlikNoVerify()],
            'birth_year' => ['required','date_format:Y'],
            'first_name' => ['required', 'string', 'max:255','min:3'],
            'last_name' => ['required', 'string', 'max:255','min:2'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            ])->setAttributeNames([
                'first_name' => 'Ad',
                'last_name' => 'Soyad',
                'email' => 'E-posta',
                'tc_kn' => 'TC Kimlik',
                'birth_year' => 'Doğum Tarihi'
        ])->setCustomMessages([
            'birth_year.date_format' => 'Doğum tarihi hatalı.'
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail)
        {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
            ])->save();
        }
/*
        if( $input['tckn'] !== $user->tckn || $input['birth_year'] !== $user->birth_year )
        {
            $tcsor = TCKimlikNo::validate(
                $input['tckn'],
                $input['first_name'],
                $input['last_name'],
                $input['birth_year']
            );
            if (!$tcsor){
                flash('TC Kimlik bilginiz doğrulanmadı!')->error();
            }else{
                flash('TC Kimlik bilginiz doğrulandı.')->success();
            }
            $user->forceFill([
                'tckn' => $input['tckn'],
                'birth_year' => $input['birth_year'],
                'tckn_verified_at' => $tcsor?now():null,
            ])->save();
        }
*/
        flash('Hesap bilgileri güncellendi.')->success();

    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
