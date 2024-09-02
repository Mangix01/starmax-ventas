<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table='auditorias';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'operacion','notas',
    ];
    
    
    public function user()
    {   
        return $this->belongsTo(User::class,'user_id');
    }
    
    
    protected $guarded =[

    ];
}
