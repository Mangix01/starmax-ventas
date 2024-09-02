<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='documentos';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'id','tipo_documento','numero_documento',
    ];
    
    
    
    protected $guarded =[

    ];
}
