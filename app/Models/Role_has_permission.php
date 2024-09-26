<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role_has_permission extends Model
{
    protected $table='role_has_permissions';

    protected $primaryKey='permission_id';

    public $timestamps=false;

    protected $fillable =[
    	
    ];
    
    
    public function permission()
    {   
        return $this->belongsTo(Permission::class,'permission_id');
    }
    
    public function role()
    {   
        return $this->belongsTo(Role::class,'role_id');
    }
    
    protected $guarded =[
    ];
}
