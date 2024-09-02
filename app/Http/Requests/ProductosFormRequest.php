<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductosFormRequest extends Request
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
                    'idCategoria'=>'required',
                    'codigo'=>'max:60',
                    'nombre'=>'required|unique:productos|max:100',
                    'stock'=>'required',
                    'marca'=>'required|max:50',
                    'descripcion'=>'max:255',
                    'precio'=>'required',
                    'imagen'=>'max:1000000',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'idCategoria'=>'required',
                    'codigo'=>'max:60',
                    'nombre'=>'required|unique:productos,nombre,'.$this->id.',id|max:100',
                    'stock'=>'required',
                    'marca'=>'required|max:50',
                    'descripcion'=>'max:255',
                    'precio'=>'required',
                    'imagen'=>'max:1000000',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
