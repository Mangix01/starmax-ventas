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
                    'tipo_persona' => 'required|max:9',
                    'razon_social' => 'required|max:100|regex:/^[A-Z\s]+$/',
                    'tipo_documento' => 'required|in:CI,Licencia de conducir,NIT,RUC,pasaporte',
                    'numero_documento' => 'required|alpha_num|max:45|unique:personas',
                    'direccion' => 'required|max:70',
                    'telefono' => 'required|regex:/^\+?[0-9\s\-]*$/|max:15',
                    'email' => 'required|email|max:100|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,7}$/',
                    'estado' => '',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'tipo_persona' => 'required|max:9',
                    'razon_social' => 'required|max:100|regex:/^[A-Z\s]+$/',
                    'tipo_documento' => 'required|in:CI,Licencia de conducir,NIT,RUC,pasaporte',
                    'numero_documento' => 'required|alpha_num|max:45|unique:personas,numero_documento,' . $this->id . ',id',
                    'direccion' => 'required|max:70',
                    'telefono' => 'required|regex:/^\+?[0-9\s\-]*$/|max:15',
                    'email' => 'required|email|max:100|regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,7}$/',
                    'estado' => '',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
