<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RolesFormRequest extends Request
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
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':    // Creación de un nuevo registro
                $rules = [
                    'name' => 'required|string|min:3|max:255|alpha_num|unique:roles,name',
                    'guard_name' => 'required|string|min:3|max:255|alpha_num',
                ];
                break;
    
            case 'PATCH':   // Edición de un registro existente
                $rules = [
                    'name' => 'required|string|min:3|max:255|alpha_num|unique:roles,name,' . $this->route('role')->id,
                    'guard_name' => 'required|string|min:3|max:255|alpha_num',
                ];
                break;
    
            case 'DELETE':
            default:
                $rules = [];
        }
    
        return $rules;
    }
}
