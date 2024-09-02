<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Documento;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DocumentosFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class DocumentosControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list documentos', ['only' => ['index']]),
    //         new Middleware('permission:create documentos', ['only' => ['create','store']]),
    //         new Middleware('permission:edit documentos', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete documentos', ['only' => ['destroy']]),
    //         new Middleware('permission:show documentos', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $documentos=Documento::orderBy('id', 'desc')->paginate(10);
            return view('documentos.index',compact('documentos','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $documentos=Documento::paginate(1000);
            return view('documentos.report',compact('documentos'));
        }
    }
    public function create(){
        
        return view('documentos.create',compact());
    }
    public function store (DocumentosFormRequest $request){
        try{
            $documento=new Documento;
            $documento->id = $request->get('id');
            $documento->tipo_documento = $request->get('tipo_documento');
            $documento->numero_documento = $request->get('numero_documento');
            $documento->save();
            LogHelper::guardarLog('Crear Documento','Se ha creado un nuevo Documento');
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $documento=Documento::findOrFail($id);
        return view('documentos.show',compact('documento',));
    }
    public function edit($id){
        $documento=Documento::findOrFail($id);
        return view('documentos.edit',compact('documento',));
    }
    public function update(DocumentosFormRequest $request,$id){
        try{
            $documento=Documento::findOrFail($id);
    		$documento->id = $request->get('id');
            $documento->tipo_documento = $request->get('tipo_documento');
            $documento->numero_documento = $request->get('numero_documento');
            $documento->update();
            LogHelper::guardarLog('Modificar Documento','Se ha creado un nuevo Documento');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('documentos');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $documento=Documento::findOrFail($id);
            $documento->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Documento esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('documentos');
    }
    
    
}
