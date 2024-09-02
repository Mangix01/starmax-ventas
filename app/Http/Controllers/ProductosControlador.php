<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Categoria;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductosFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class ProductosControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list productos', ['only' => ['index']]),
    //         new Middleware('permission:create productos', ['only' => ['create','store']]),
    //         new Middleware('permission:edit productos', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete productos', ['only' => ['destroy']]),
    //         new Middleware('permission:show productos', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $productos=Producto::orderBy('id', 'desc')->paginate(10);
            return view('productos.index',compact('productos','searchText','categorias',));
        }
    }
    public function report(Request $request){
        if ($request){
            $productos=Producto::paginate(1000);
            return view('productos.report',compact('productos'));
        }
    }
    public function create(){
        $categorias=Categoria::where('estado',true)->get();
        
        return view('productos.create',compact('categorias',));
    }
    public function store (ProductosFormRequest $request){
        // try{
            $producto=new Producto;
            $producto->idCategoria = $request->get('idCategoria');
            $producto->codigo = $request->get('codigo');
            $producto->nombre = $request->get('nombre');
            $producto->stock = $request->get('stock');
            $producto->marca = $request->get('marca');
            $producto->descripcion = $request->get('descripcion');
            $producto->precio = $request->get('precio');
            
            // Storage::delete($producto->imagen);  // para store no es necesario.
            if($request->hasFile('imagen')){   
               $producto->imagen=$request->file('imagen')->store('public/producto');
            }
            $producto->estado = $request->get('estado');
            $producto->save();
            
            LogHelper::guardarLog('Crear Producto','Se ha creado un nuevo Producto');

            toastr()->success(__('Grabación exitosa...'));
        // }catch(\Exception $e){
        //     //DB::rollback(); // en caso de error anulo transaccion
        //     toastr()->error(__('La grabación NO ha sido exitosa'));
        // }
        return Redirect::back();
    }
    public function show($id){
        $producto=Producto::findOrFail($id);
        $categorias=Categoria::where('estado',true)->get();
        return view('productos.show',compact('producto','categorias',));
    }
    public function edit($id){
        $producto=Producto::findOrFail($id);
        $categorias=Categoria::where('estado',true)->get();
        return view('productos.edit',compact('producto','categorias',));
    }
    public function update(ProductosFormRequest $request,$id){
        try{
            $producto=Producto::findOrFail($id);
    		$producto->idCategoria = $request->get('idCategoria');
            $producto->codigo = $request->get('codigo');
            $producto->nombre = $request->get('nombre');
            $producto->stock = $request->get('stock');
            $producto->marca = $request->get('marca');
            $producto->descripcion = $request->get('descripcion');
            $producto->precio = $request->get('precio');
            
            // Storage::delete($producto->imagen);  // para store no es necesario.
            if($request->hasFile('imagen')){   
               $producto->imagen=$request->file('imagen')->store('public/producto');
            }
            $producto->estado = $request->get('estado');
            $producto->update();
            
            LogHelper::guardarLog('Modificación Producto','Se ha modificado un Producto');

            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('productos');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $producto=Producto::findOrFail($id);
            $producto->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Producto esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('productos');
    }
    public function cambiarEstado($id){
        $producto= Producto::findOrFail($id);
        $producto->estado = !$producto->estado;     // cambiar el estado de la producto
        $producto->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
    
}
