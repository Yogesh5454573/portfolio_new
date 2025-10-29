<?php

namespace App\Http\Requests\Admin;

use App\Models\Info;
use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //  dd($this->all(), $this->method());
        if ($this->isMethod('put')) {
            return [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'dob' => ['required'],
                'degree' => ['required'],
                'experience' => ['required'],
                'phone' => ['required'],
                'email' => ['required'],
                'about_me' => ['required'],
                'address' => ['required'],
                'freelance' => ['required'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'resume_file' => ['nullable', 'mimes:pdf', 'max:2048']
            ];
        } else if ($this->isMethod('post')) {
            // dd('hii');
            return [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'dob' => ['required'],
                'degree' => ['required'],
                'experience' => ['required'],
                'phone' => ['required'],
                'email' => ['required'],
                'about_me' => ['required'],
                'address' => ['required'],
                'freelance' => ['required'],
                'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg','max:2048'],
                'resume_file' => ['nullable', 'mimes:pdf', 'max:2048']
            ];
        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'dob' => 'Date of Birth',
            'degree' => 'Degree',
            'experience' => 'Experience',
            'phone' => 'Phone',
            'email' => 'Email',
            'about_me' => 'About Me',
            'address' => 'Address',
            'freelance' => 'Freelance',
            'photo' => 'Photo',
            'resume_file' => 'Resume File'
        ];
    }
}
