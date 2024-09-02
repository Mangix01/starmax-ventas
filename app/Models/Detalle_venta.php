<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    protected $table='detalle_ventas';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idProducto','cantidad','precio','descuento','subtotal','idVenta',
    ];
    
    
    public function producto()
    {   
        return $this->belongsTo(Producto::class,'idProducto');
    }
    
    
    protected $guarded =[

    ];
}
