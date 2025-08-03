<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            $updateSkills = Service::where(['token' => $this->token])->first();
            return [
                'ser_name' => ['required', 'string', 'min:3', 'max:255'],
                'ser_desc' => ['required'],
                'status' => ['required']
            ];
        } else if ($this->isMethod('post')) {
            return [
                'ser_name' => ['required', 'string', 'min:3', 'max:255'],
                'ser_desc' => ['required'],
                'status' => ['required']
            ];

        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'ser_name' => 'Skill Name',
            'ser_desc' => 'Skill Percentage',
            'status' => 'Active'
        ];
    }
}
