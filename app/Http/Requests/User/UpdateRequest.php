<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'bail|required|integer|exists:App\Models\Role,id',
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer|exists:App\Models\Permission,id',
        ];
    }
}
