<?php

namespace App\Http\Requests\API\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
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
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'role' => 'integer',
            'gender' => 'integer',
            'address' => 'string',
            'telephone' => 'string',
            'email' => 'string|email:rfc',
            'password' => ['string', Password::min(8)->mixedCase()->numbers()],
        ];
    }
}
