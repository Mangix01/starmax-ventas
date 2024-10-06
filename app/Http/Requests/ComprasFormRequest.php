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
                    'fecha_recepcion' => '',
                    'numero_comprobante' => 'required|max:50|regex:/^[A-Za-z0-9]+$/', // Validación de alfanumérico
                    'estado' => '',
                    'total' => 'required|numeric|min:0', // Total no puede ser negativo
                    'idComprobante' => 'required',
                    'idProveedore' => 'required',
                    // Agrega aquí más reglas si es necesario
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'numero_comprobante.required' => 'El número de comprobante es obligatorio.',
                    'numero_comprobante.regex' => 'El número de comprobante debe ser alfanumérico.',
                    'total.required' => 'El total es obligatorio.',
                    'total.min' => 'El total no puede ser negativo.',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;
    }
}
