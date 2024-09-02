<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DocumentosFormRequest extends Request
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
                    'id'=>'required',
                    'tipo_documento'=>'required|max:45',
                    'numero_documento'=>'required|unique:documentos|max:45',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'id'=>'required',
                    'tipo_documento'=>'required|max:45',
                    'numero_documento'=>'required|unique:documentos,numero_documento,'.$this->id.',id|max:45',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
