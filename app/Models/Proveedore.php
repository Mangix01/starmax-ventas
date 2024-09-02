<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $table='proveedores';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idPersona',
    ];
    
    
    public function persona()
    {   
        return $this->belongsTo(Persona::class,'idPersona');
    }
    
    
    protected $guarded =[

    ];
}
