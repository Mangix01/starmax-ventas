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
                    'idCategoria' => 'required',
                    'codigo' => 'required|alpha_num|max:60',
                    'nombre' => 'required|regex:/^[\p{L}0-9\s]+$/u|max:100',
                    'stock' => 'required|integer|min:0', // Stock no puede ser negativo
                    'marca' => 'required|alpha_num|max:50',
                    'descripcion' => 'nullable|max:255|regex:/^[^<>]*$/', // Sin caracteres especiales
                    'precio' => 'required|numeric|min:0', // Precio no puede ser negativo
                    'imagen' => 'nullable|max:1000000',
                    'estado' => '',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'idCategoria' => 'required',
                    'codigo' => 'required|alpha_num|max:60',
                    'nombre' => 'required|regex:/^[\p{L}0-9\s]+$/u|max:100|unique:productos,nombre,' . $this->id . ',id',
                    'stock' => 'required|integer|min:0', // Stock no puede ser negativo
                    'marca' => 'required|alpha_num|max:50',
                    'descripcion' => 'nullable|max:255|regex:/^[^<>]*$/', // Sin caracteres especiales
                    'precio' => 'required|numeric|min:0', // Precio no puede ser negativo
                    'imagen' => 'nullable|max:1000000',
                    'estado' => '',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }

        return $rules;



    }
}
