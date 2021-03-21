<?php

namespace App\Http\Controllers\Fortify;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource as UserResource;

class ProfileInformationController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);

        $this->checkValidation($validator);

        if ($request->email !== Auth::user()->email &&
        Auth::user() instanceof MustVerifyEmail) {
            $this->updateVerifiedUser(Auth::user(), $request->all());

        } else {
            Auth::user()->forceFill([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
//                'email' => $request->email,
            ])->save();
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Profile Updated!',
            'data' => new UserResource(Auth::user())
        ]);
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function updateProfilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => ['required', 'image', 'max:1024'],
        ]);

        $this->checkValidation($validator);

        dd($request->all());
        Auth::user()->updateProfilePhoto($request->photo);

        return response()->json([
            'status' => 'ok',
            'message' => 'Profile photo Uploaded!',
            'data' => new UserResource(Auth::user())
        ]);
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
//            'email' => $input['email'],
//            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * check Validation.
     *
     * @param  ValidatorContract $validator
     */
    protected function checkValidation(ValidatorContract $validator)
    {
        if(optional($validator)->fails()){
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors(),
            ], 422);
        }
    }
}
