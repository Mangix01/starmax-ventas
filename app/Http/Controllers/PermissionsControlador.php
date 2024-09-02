<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Permission;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PermissionsFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

class PermissionsControlador extends Controller
{
    public function __construct(){
       
    }
    public static function middleware(): array
    {
        return [
            new Middleware('permission:list permissions', ['only' => ['index']]),
            new Middleware('permission:create permissions', ['only' => ['create','store']]),
            new Middleware('permission:edit permissions', ['only' => ['edit','update']]),
            new Middleware('permission:delete permissions', ['only' => ['destroy']]),
            new Middleware('permission:show permissions', ['only' => ['show']])
        ];
    }
    public function index(Request $request){
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $permissions=Permission::orderBy('id', 'desc')->paginate(10);
            return view('permissions.index',compact('permissions','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $permissions=Permission::paginate(1000);
            return view('permissions.report',compact('permissions'));
        }
    }
    public function create(){
        
        return view('permissions.create',compact());
    }
    public function store (PermissionsFormRequest $request){
        try{
            $permission=new Permission;
            $permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $permission->tabla = $request->get('tabla');
            $permission->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $permission=Permission::findOrFail($id);
        return view('permissions.show',compact('permission',));
    }
    public function edit($id){
        $permission=Permission::findOrFail($id);
        return view('permissions.edit',compact('permission',));
    }
    public function update(PermissionsFormRequest $request,$id){
        try{
            $permission=Permission::findOrFail($id);
    		$permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $permission->tabla = $request->get('tabla');
            $permission->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('permissions');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $permission=Permission::findOrFail($id);
            $permission->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Permission esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('permissions');
    }
    
}
