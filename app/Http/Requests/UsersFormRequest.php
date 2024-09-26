<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':    // Nuevo
                $rules = [
                    'name' => 'required|string|min:4|max:255|regex:/^[\p{L}\s]+$/|unique:users,name',
                    'email' => 'required|email|max:255|unique:users,email',
                    'password' => 'required|max:255',
                    'remember_token' => 'max:100',
                ];
                break;
    
            case 'PATCH':   // Edición
                $rules = [
                    'name' => 'required|string|min:4|max:255|regex:/^[\p{L}\s]+$/|unique:users,name,',
                    'email' => 'required|email|max:255|unique:users,email,',
                    'password' => 'required|max:255',
                    'remember_token' => 'max:100',
                ];
                break;
    
            case 'DELETE':
            default:
                $rules = [];
        }
    
        return $rules;
    }

    public function messages()
{
    return [
        'name.regex' => 'Solo se permiten letras y espacios en el nombre completo.',
    ];
}
}
