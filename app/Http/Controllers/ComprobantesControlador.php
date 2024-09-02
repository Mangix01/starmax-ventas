<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comprobante;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ComprobantesFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class ComprobantesControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list comprobantes', ['only' => ['index']]),
    //         new Middleware('permission:create comprobantes', ['only' => ['create','store']]),
    //         new Middleware('permission:edit comprobantes', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete comprobantes', ['only' => ['destroy']]),
    //         new Middleware('permission:show comprobantes', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $comprobantes=Comprobante::orderBy('id', 'desc')->paginate(10);
            return view('comprobantes.index',compact('comprobantes','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $comprobantes=Comprobante::paginate(1000);
            return view('comprobantes.report',compact('comprobantes'));
        }
    }
    public function create(){
        
        return view('comprobantes.create',compact());
    }
    public function store (ComprobantesFormRequest $request){
        try{
            $comprobante=new Comprobante;
            $comprobante->tipo_comprobante = $request->get('tipo_comprobante');
            $comprobante->estado = $request->get('estado');
            $comprobante->save();
            LogHelper::guardarLog('Crear Comprobante','Se ha creado un nuevo Comprobante');
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $comprobante=Comprobante::findOrFail($id);
        return view('comprobantes.show',compact('comprobante',));
    }
    public function edit($id){
        $comprobante=Comprobante::findOrFail($id);
        return view('comprobantes.edit',compact('comprobante',));
    }
    public function update(ComprobantesFormRequest $request,$id){
        try{
            $comprobante=Comprobante::findOrFail($id);
    		$comprobante->tipo_comprobante = $request->get('tipo_comprobante');
            $comprobante->estado = $request->get('estado');
            $comprobante->update();
            LogHelper::guardarLog('Actualiza Comprobante','Se ha actualizado un Comprobante');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('comprobantes');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $comprobante=Comprobante::findOrFail($id);
            $comprobante->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Comprobante esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('comprobantes');
    }
    public function cambiarEstado($id){
        $comprobante= Comprobante::findOrFail($id);
        $comprobante->estado = !$comprobante->estado;     // cambiar el estado de la comprobante
        $comprobante->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
    
}
