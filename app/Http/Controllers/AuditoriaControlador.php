<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auditori;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AuditoriaFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;



class AuditoriaControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list auditoria', ['only' => ['index']]),
    //         new Middleware('permission:create auditoria', ['only' => ['create','store']]),
    //         new Middleware('permission:edit auditoria', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete auditoria', ['only' => ['destroy']]),
    //         new Middleware('permission:show auditoria', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $auditoria=Auditori::orderBy('id', 'desc')->paginate(10);
            return view('auditoria.index',compact('auditoria','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $auditoria=Auditori::paginate(1000);
            return view('auditoria.report',compact('auditoria'));
        }
    }
    public function create(){
        
        return view('auditoria.create',compact());
    }
    public function store (AuditoriaFormRequest $request){
        try{
            $auditori=new Auditori;
            $auditori->operacion = $request->get('operacion');
            $auditori->notas = $request->get('notas');
            $auditori->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $auditori=Auditori::findOrFail($id);
        return view('auditoria.show',compact('auditori',));
    }
    public function edit($id){
        $auditori=Auditori::findOrFail($id);
        return view('auditoria.edit',compact('auditori',));
    }
    public function update(AuditoriaFormRequest $request,$id){
        try{
            $auditori=Auditori::findOrFail($id);
    		$auditori->operacion = $request->get('operacion');
            $auditori->notas = $request->get('notas');
            $auditori->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('auditoria');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $auditori=Auditori::findOrFail($id);
            $auditori->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Auditoria esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('auditoria');
    }
    
    
}
