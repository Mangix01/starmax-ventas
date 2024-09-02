<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table='compras';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'fecha_recepcion','numero_comprobante','estado','total','idComprobante','idProveedore',
    ];
    
    
    public function comprobante()
    {   
        return $this->belongsTo(Comprobante::class,'idComprobante');
    }
    
    public function proveedore()
    {   
        return $this->belongsTo(Proveedore::class,'idProveedore');
    }
    
    
    protected $guarded =[

    ];
}
