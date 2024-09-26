<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuariosFormRequest extends Request
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
    public function rules(){
        switch ($this->method()) {
            case 'POST':    //Nuevo
                $rules = [
                    'nombre' => 'required|string|min:4|max:45|regex:/^[\p{L}\s]+$/|unique:users,nombre',
                    'nombre_usuario' => 'required|string|min:4|max:45|alpha_num|unique:users,nombre_usuario',
                    'password' => 'required|max:20',
                    'email' => 'required|email|min:4|max:45|unique:users,email',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre' => 'required|string|min:4|max:45|regex:/^[\p{L}\s]+$/|unique:users,nombre',
                    'nombre_usuario' => 'required|string|min:4|max:45|alpha_num|unique:users,nombre_usuario',
                    'password' => 'required|max:20',
                    'email' => 'required|email|min:4|max:45|unique:users,email',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;
    }
}
