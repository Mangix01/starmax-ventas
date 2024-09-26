<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VentasFormRequest extends Request
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
                    'numero_comprobante'=>'required|max:20',
                    'total' => 'required|numeric|min:0', // El total debe ser un número positivo
                    'estado'=>'',
                    'idCliente'=>'required',
                    'idComprobante'=>'required',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'numero_comprobante'=>'required|max:20',
                    'total'=>'required',
                    'estado'=>'',
                    'idCliente'=>'required',
                    'idComprobante'=>'required',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }
        return $rules;
    }
}
