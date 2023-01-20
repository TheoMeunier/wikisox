<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules =  [
            'name'        => 'required|min:3',
            'email'       => 'required|email',
        ];

        if ($this->route('admin.users.store')) {
            $rules[] = ['password' => 'required|confirmed|min:6'];
        }

        return $rules;
    }
}
