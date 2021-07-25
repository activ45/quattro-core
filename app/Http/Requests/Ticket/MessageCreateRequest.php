<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'body' => 'required|min:6|string',
            'attachment' => 'nullable|file|max:8500'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'attachment.max' => 'Ek dosya değeri 8.3mb değerinden küçük olmalıdır.'
        ];
    }
    public function attributes()
    {
        return [
            'body' => 'Mesaj',
            'attachment' => 'Ek dosya'
        ];
    }
}
