<?php

namespace App\Http\Requests\API\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|integer',
            'gender' => 'required|integer',
            'address' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|string|email:rfc|unique:users',
            'password' => ['required','string','required_with:confirm_password','same:confirm_password', Password::min(8)->mixedCase()->numbers()],
            'confirm_password' => 'required|string',
        ];
    }
}
