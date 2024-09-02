<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='clientes';

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
