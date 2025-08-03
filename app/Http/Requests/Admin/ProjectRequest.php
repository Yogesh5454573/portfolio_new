<?php

namespace App\Http\Requests\Admin;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            $updateSkills = Project::where(['token' => $this->token])->first();
            return [
                'proj_name' => ['required', 'string', 'min:3', 'max:255'],
                'proj_link' => ['required'],
                'proj_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'status' => ['required']
            ];
        } else if ($this->isMethod('post')) {
            return [
                'proj_name' => ['required', 'string', 'min:3', 'max:255'],
                'proj_link' => ['required'],
                // 'proj_img' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
                'status' => ['required']
            ];

        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'proj_name' => 'Project Name',
            'proj_link' => 'Project link',
            'proj_img' => 'Project Image',
            'status' => 'Status'
        ];
    }
}
