<?php

namespace App\Http\Requests\Ticket;

use App\Enums\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required','string',Rule::in(TicketStatus::values())]
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'status' => 'Durum'
        ];
    }
}
