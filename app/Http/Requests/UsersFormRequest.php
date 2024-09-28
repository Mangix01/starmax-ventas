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
                    'name' => 'required|max:255|unique:users|regex:/^[A-Z\s]+$/', // Solo letras mayúsculas y espacios
                    'email' => 'required|unique:users|email|max:255|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,7}$/', // Ajustado para incluir caracteres válidos
                    'password' => 'required|max:255',
                    'remember_token' => 'max:100',
                ];
                break;
    
            case 'PATCH':   // Edición
                $rules = [
                    'name' => 'required|max:255|unique:users,name,' . $this->id . '|regex:/^[A-Z\s]+$/',
                    'email' => 'required|unique:users,email,' . $this->id . '|email|max:255|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,7}$/',
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
