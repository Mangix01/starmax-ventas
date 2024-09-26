<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='personas';

    protected $primaryKey='id';

    public $timestamps=true;
    
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable =[
    	'tipo_persona','razon_social','tipo_documento','numero_documento','direccion','telefono','email','estado',
    ];
    
    
    
    protected $guarded =[

    ];
}
