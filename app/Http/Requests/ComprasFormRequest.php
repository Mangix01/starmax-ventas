<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ComprasFormRequest extends Request
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
                    'fecha_recepcion'=>'',
                    'numero_comprobante'=>'required|max:50',
                    'estado'=>'',
                    'total'=>'required',
                    'idComprobante'=>'required',
                    'idProveedore'=>'required',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'fecha_recepcion'=>'',
                    'numero_comprobante'=>'required|max:50',
                    'estado'=>'',
                    'total'=>'required',
                    'idComprobante'=>'required',
                    'idProveedore'=>'required',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
