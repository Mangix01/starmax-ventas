<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComprobantesFormRequest extends Request
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
                    'tipo_comprobante'=>'required|unique:comprobantes|max:60',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'tipo_comprobante'=>'required|unique:comprobantes,tipo_comprobante,'.$this->id.',id|max:60',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
