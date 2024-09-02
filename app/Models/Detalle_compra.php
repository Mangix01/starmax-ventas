<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Detalle_compra extends Model
{
    protected $table='detalle_compras';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idProducto','cantidad','precio','subtotal','idCompra',
    ];
    
    
    public function producto()
    {   
        return $this->belongsTo(Producto::class,'idProducto');
    }
    
    
    protected $guarded =[

    ];
}
