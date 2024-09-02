<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Proveedore;
use App\Models\Persona;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProveedoresFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class ProveedoresControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list proveedores', ['only' => ['index']]),
    //         new Middleware('permission:create proveedores', ['only' => ['create','store']]),
    //         new Middleware('permission:edit proveedores', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete proveedores', ['only' => ['destroy']]),
    //         new Middleware('permission:show proveedores', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        $personas=Persona::where('estado',true)->get();
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $proveedores=Proveedore::orderBy('id', 'desc')->paginate(10);
            return view('proveedores.index',compact('proveedores','searchText','personas',));
        }
    }
    public function report(Request $request){
        if ($request){
            $proveedores=Proveedore::paginate(1000);
            return view('proveedores.report',compact('proveedores'));
        }
    }
    public function create(){
        $personas=Persona::where('estado',true)->get();
        
        return view('proveedores.create',compact('personas',));
    }
    public function store (ProveedoresFormRequest $request){
        try{
            $proveedore=new Proveedore;
            $proveedore->idPersona = $request->get('idPersona');
            $proveedore->save();
            LogHelper::guardarLog('Crea Proveedor','Se ha creado un nuevo Proveedor');
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $proveedore=Proveedore::findOrFail($id);
        $personas=Persona::where('estado',true)->get();
        return view('proveedores.show',compact('proveedore','personas',));
    }
    public function edit($id){
        $proveedore=Proveedore::findOrFail($id);
        $personas=Persona::where('estado',true)->get();
        return view('proveedores.edit',compact('proveedore','personas',));
    }
    public function update(ProveedoresFormRequest $request,$id){
        try{
            $proveedore=Proveedore::findOrFail($id);
    		$proveedore->idPersona = $request->get('idPersona');
            $proveedore->update();
             LogHelper::guardarLog('Actualiza Proveedor','Se ha actualizado un nuevo Proveedor');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('proveedores');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $proveedore=Proveedore::findOrFail($id);
            $proveedore->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Proveedore esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('proveedores');
    }
    
    
}
