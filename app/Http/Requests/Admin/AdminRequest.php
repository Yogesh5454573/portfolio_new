<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            $updateAdmin = Admin::where(['token' => $this->token])->first();
            return [
                'admin_type' => ['required'],
                'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'email' => ['required', 'email', 'max:255', Rule::unique(Admin::class)->ignore($updateAdmin->id), 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'password' => ['nullable', Password::min(8)->letters()->numbers()->symbols()->mixedCase()],
            ];
        } else if ($this->isMethod('post')) {
            return [
                'admin_type' => ['required'],
                'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'email' => ['required', 'email', 'max:255', Rule::unique(Admin::class), 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
                'password' => ['required', Password::min(8)->letters()->numbers()->symbols()->mixedCase()],
                'status' => ['required']
            ];
        }

        return [];
    }

    public function attributes(): array
    {
        return [
            'admin_type' => 'Admin Type',
            'name' => 'Name',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Active',
        ];
    }
}
