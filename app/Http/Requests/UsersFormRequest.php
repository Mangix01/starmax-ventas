<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersFormRequest extends Request
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
                    'name'=>'required|max:255',
                    'email'=>'required|unique:users|email|max:255',
                    'password'=>'required|max:255',
                    'remember_token'=>'max:100',
                    
                ];
                break;                
            case 'PATCH':   //edicion
                $rules = [
                    'name'=>'required|max:255',
                    'email'=>'required|unique:users,id,'.$this->id.',id|email|max:255',
                    'password'=>'required|max:255',
                    'remember_token'=>'max:100',
                    
                ];
                break;
            case 'DELETE':
            default:
               
        }
        return $rules;
    }
}
