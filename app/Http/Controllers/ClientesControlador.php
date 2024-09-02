<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Persona;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ClientesFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class ClientesControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list clientes', ['only' => ['index']]),
    //         new Middleware('permission:create clientes', ['only' => ['create','store']]),
    //         new Middleware('permission:edit clientes', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete clientes', ['only' => ['destroy']]),
    //         new Middleware('permission:show clientes', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        $personas=Persona::where('estado',true)->get();
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $clientes=Cliente::orderBy('id', 'desc')->paginate(10);
            return view('clientes.index',compact('clientes','searchText','personas',));
        }
    }
    public function report(Request $request){
        if ($request){
            $clientes=Cliente::paginate(1000);
            return view('clientes.report',compact('clientes'));
        }
    }
    public function create(){
        $personas=Persona::where('estado',true)->get();
        
        return view('clientes.create',compact('personas',));
    }
    public function store (ClientesFormRequest $request){
        try{
            $cliente=new Cliente;
            $cliente->idPersona = $request->get('idPersona');
            $cliente->save();
            LogHelper::guardarLog('Crea Cliente','Se ha creado un nuevo Cliente');
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $cliente=Cliente::findOrFail($id);
        $personas=Persona::where('estado',true)->get();
        return view('clientes.show',compact('cliente','personas',));
    }
    public function edit($id){
        $cliente=Cliente::findOrFail($id);
        $personas=Persona::where('estado',true)->get();
        return view('clientes.edit',compact('cliente','personas',));
    }
    public function update(ClientesFormRequest $request,$id){
        try{
            $cliente=Cliente::findOrFail($id);
    		$cliente->idPersona = $request->get('idPersona');
            $cliente->update();
            LogHelper::guardarLog('Modificación Cliente','Se ha modificado un Cliente');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('clientes');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $cliente=Cliente::findOrFail($id);
            $cliente->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Cliente esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('clientes');
    }
    
    
}
