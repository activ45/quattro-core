<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'subject' => 'required|min:8|string',
            'body' => 'required|min:6|string',
            'department' => 'required|string|exists:departments,slug',
            'attachment' => 'nullable|file|max:8500'
        ];
    }

    public function messages()
    {
        return [
            'attachment.max' => 'Ek dosya değeri 8.3mb değerinden küçük olmalıdır.'
        ];
    }
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'subject' => 'Başlık',
            'body' => 'Mesaj',
            'department' => 'Departman',
            'attachment' => 'Ek dosya'
        ];
    }
}
