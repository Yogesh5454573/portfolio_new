<?php

namespace App\Http\Requests\Admin;

use App\Models\Experence;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExperenceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            return [
                'ex_name' => ['required', 'string', 'min:3', 'max:255'],
                'com_name' => ['required', 'string', 'min:3', 'max:255'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'status' => ['required'],
                'com_des' => ['required',  'string', 'max:1000'],
            ];
        } else if ($this->isMethod('post')) {
            return [
                'ex_name' => ['required', 'string', 'min:3', 'max:255'],
                'com_name' => ['required', 'string', 'min:3', 'max:255'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'status' => ['required'],
                'com_des' => ['required',  'string', 'max:1000']
            ];

        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'ex_name' => 'Experence Name',
            'com_name' => 'Company Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'com_des' => 'Company Description'
        ];
    }
}
