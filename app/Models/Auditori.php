<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Auditori extends Model
{
    protected $table='auditoria';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'operacion','notas',
    ];
    
    
    
    protected $guarded =[

    ];
}
