<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table='comprobantes';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'tipo_comprobante','estado',
    ];
    
    
    
    protected $guarded =[

    ];
}
