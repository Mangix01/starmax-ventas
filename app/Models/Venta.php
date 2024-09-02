<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='ventas';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'numero_comprobante','total','estado','idCliente','idComprobante',
    ];
    
    
    public function cliente()
    {   
        return $this->belongsTo(Cliente::class,'idCliente');
    }
    
    public function comprobante()
    {   
        return $this->belongsTo(Comprobante::class,'idComprobante');
    }
    
    
    protected $guarded =[

    ];
}
