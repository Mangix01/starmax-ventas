<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Persona;
use App\Models\Cliente;
use App\Models\Proveedore;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonasFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class PersonasControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list personas', ['only' => ['index']]),
    //         new Middleware('permission:create personas', ['only' => ['create','store']]),
    //         new Middleware('permission:edit personas', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete personas', ['only' => ['destroy']]),
    //         new Middleware('permission:show personas', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $personas=Persona::orderBy('id', 'desc')->paginate(10);
            return view('personas.index',compact('personas','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $personas=Persona::paginate(1000);
            return view('personas.report',compact('personas'));
        }
    }
    public function create(){
        
        return view('personas.create',compact());
    }
    public function store (PersonasFormRequest $request){
        try{
            $persona=new Persona;
            $persona->tipo_persona = $request->get('tipo_persona');
            $persona->razon_social = $request->get('razon_social');
            $persona->tipo_documento = $request->get('tipo_documento');
            $persona->numero_documento = $request->get('numero_documento');
            $persona->direccion = $request->get('direccion');
            $persona->telefono = $request->get('telefono');
            $persona->email = $request->get('email');
            $persona->estado = $request->get('estado');
            $persona->save();
            LogHelper::guardarLog('Crea Persona','Se ha creado un nuevo Persona');

            if($persona->tipo_persona=='Cliente'){
                 $cliente=new Cliente;
                $cliente->idPersona = $persona->id;
                $cliente->save();
                LogHelper::guardarLog('Crea Cliente','Se ha creado un nuevo Cliente');
            }
            if($persona->tipo_persona=='Proveedor'){
                $proveedore=new Proveedore;
                $proveedore->idPersona = $persona->id;
                $proveedore->save();
                LogHelper::guardarLog('Crea Proveedor','Se ha creado un nuevo Proveedor');
            }
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $persona=Persona::findOrFail($id);
        return view('personas.show',compact('persona',));
    }
    public function edit($id){
        $persona=Persona::findOrFail($id);
        return view('personas.edit',compact('persona',));
    }
    public function update(PersonasFormRequest $request,$id){
        try{
            $persona=Persona::findOrFail($id);
    		$persona->tipo_persona = $request->get('tipo_persona');
            $persona->razon_social = $request->get('razon_social');
            $persona->tipo_documento = $request->get('tipo_documento');
            $persona->numero_documento = $request->get('numero_documento');
            $persona->direccion = $request->get('direccion');
            $persona->telefono = $request->get('telefono');
            $persona->email = $request->get('email');
            $persona->estado = $request->get('estado');
            $persona->update();
            LogHelper::guardarLog('Actualiza Persona','Se ha actualizado una Persona');

            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('personas');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $persona=Persona::findOrFail($id);
            $persona->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Persona esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('personas');
    }
    public function cambiarEstado($id){
        $persona= Persona::findOrFail($id);
        $persona->estado = !$persona->estado;     // cambiar el estado de la persona
        $persona->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
    
}
