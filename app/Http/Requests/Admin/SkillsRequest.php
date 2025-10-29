<?php

namespace App\Http\Requests\Admin;

use App\Models\Skills;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SkillsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            $updateSkills = Skills::where(['token' => $this->token])->first();
            return [
                'skill_type'=> ['required'],
                'skill_name' => ['required', 'string', 'min:3', 'max:255'],
                'skill_per' => ['required'],
                'status' => ['required']
            ];
        } else if ($this->isMethod('post')) {
            return [
                'skill_type'=> ['required'],
                'skill_name' => ['required', 'string', 'min:3', 'max:255'],
                'skill_per' => ['required'],
                'status' => ['required']
            ];

        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'skill_name' => 'Skill Name',
            'skill_per' => 'Skill Percentage',
            'status' => 'Active'
        ];
    }
}
