<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientesFormRequest extends Request
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
                    'idPersona'=>'required',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'idPersona'=>'required',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
