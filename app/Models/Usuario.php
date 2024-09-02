<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuarios';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'nombre','nombre_usuario','password','email',
    ];
    
    
    
    protected $guarded =[

    ];
}
