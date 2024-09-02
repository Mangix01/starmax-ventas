<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoriasFormRequest extends Request
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
                    'categoria'=>'required|unique:categorias|max:50',
                    'descripcion'=>'max:150',
                    'estado'=>'',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'categoria'=>'required|unique:categorias,categoria,'.$this->id.',id|max:50',
                    'descripcion'=>'max:150',
                    'estado'=>'',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
