<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255','min:3'],
            'last_name' => ['required', 'string', 'max:255','min:2'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'first_name' => 'Ad',
            'last_name' => 'Soyad'
        ];

    }
}
