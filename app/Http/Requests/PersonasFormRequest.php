<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonasFormRequest extends Request
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
                    'tipo_persona'=>'required|max:9',
                    'razon_social'=>'required|max:100',
                    'tipo_documento'=>'required|max:45',
                    'numero_documento'=>'required|unique:personas|max:45',
                    'direccion'=>'required|max:70',
                    'telefono'=>'required|max:15',
                    'email'=>'required|email|max:100',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'tipo_persona'=>'required|max:9',
                    'razon_social'=>'required|max:100',
                    'tipo_documento'=>'required|max:45',
                    'numero_documento'=>'required|unique:personas,numero_documento,'.$this->id.',id|max:45',
                    'direccion'=>'required|max:70',
                    'telefono'=>'required|max:15',
                    'email'=>'required|email|max:100',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
