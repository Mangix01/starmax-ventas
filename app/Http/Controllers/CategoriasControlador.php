<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriasFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class CategoriasControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list categorias', ['only' => ['index']]),
    //         new Middleware('permission:create categorias', ['only' => ['create','store']]),
    //         new Middleware('permission:edit categorias', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete categorias', ['only' => ['destroy']]),
    //         new Middleware('permission:show categorias', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $categorias=Categoria::orderBy('id', 'desc')->paginate(10);
            return view('categorias.index',compact('categorias','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $categorias=Categoria::paginate(1000);
            return view('categorias.report',compact('categorias'));
        }
    }
    public function create(){
        
        return view('categorias.create',compact());
    }
    public function store (CategoriasFormRequest $request){
        try{
            $categoria=new Categoria;
            $categoria->categoria = $request->get('categoria');
            $categoria->descripcion = $request->get('descripcion');
            $categoria->estado = $request->get('estado');
            $categoria->save();
            LogHelper::guardarLog('Crea Categoria','Se ha creado una nueva Categoria');
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $categoria=Categoria::findOrFail($id);
        return view('categorias.show',compact('categoria',));
    }
    public function edit($id){
        $categoria=Categoria::findOrFail($id);
        return view('categorias.edit',compact('categoria',));
    }
    public function update(CategoriasFormRequest $request,$id){
        try{
            $categoria=Categoria::findOrFail($id);
    		$categoria->categoria = $request->get('categoria');
            $categoria->descripcion = $request->get('descripcion');
            $categoria->estado = $request->get('estado');
            $categoria->update();
            LogHelper::guardarLog('Modificación Categoria','Se ha modificado una Categoria');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('categorias');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $categoria=Categoria::findOrFail($id);
            $categoria->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Categoria esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('categorias');
    }
    public function cambiarEstado($id){
        $categoria= Categoria::findOrFail($id);
        $categoria->estado = !$categoria->estado;     // cambiar el estado de la categoria
        $categoria->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
    
}
