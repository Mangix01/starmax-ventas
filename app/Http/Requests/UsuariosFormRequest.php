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
                    'nombre'=>'required|max:45',
                    'nombre_usuario'=>'required|max:45',
                    'password'=>'required|max:20',
                    'email'=>'required|email|max:45',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'nombre'=>'required|max:45',
                    'nombre_usuario'=>'required|max:45',
                    'password'=>'required|max:20',
                    'email'=>'required|email|max:45',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
