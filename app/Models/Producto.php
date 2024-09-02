<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='productos';

    protected $primaryKey='id';

    public $timestamps=true;
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable =[
    	'idCategoria','codigo','nombre','stock','marca','descripcion','precio','imagen','estado',
    ];
    
    
    public function categoria()
    {   
        return $this->belongsTo(Categoria::class,'idCategoria');
    }
    
    
    protected $guarded =[

    ];
}
