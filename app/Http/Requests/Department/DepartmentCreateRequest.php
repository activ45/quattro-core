<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'slug' => 'required|string|unique:departments',
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'slug' => 'Departman Kod',
            'name' => 'Departman Ad',
            'description' => 'Departman Açıklama'
        ];
    }
}
