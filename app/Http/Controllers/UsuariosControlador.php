<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuariosFormRequest;

use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;

use App\Helpers\LogHelper;

class UsuariosControlador extends Controller
{
    public function __construct(){
        
    }
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:list usuarios', ['only' => ['index']]),
    //         new Middleware('permission:create usuarios', ['only' => ['create','store']]),
    //         new Middleware('permission:edit usuarios', ['only' => ['edit','update']]),
    //         new Middleware('permission:delete usuarios', ['only' => ['destroy']]),
    //         new Middleware('permission:show usuarios', ['only' => ['show']]),
    //     ];
    // }
    public function index(Request $request){
        
        if ($request){
            $searchText=$request->get('searchText');
            $usuarios=Usuario::
                where('name','like','%'.$searchText)
                ->orWhere('email','like','%'.$searchText)
                ->orderBy('id', 'desc')->paginate(10);
            return view('usuarios.index',compact('usuarios','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $usuarios=Usuario::paginate(1000);
            return view('usuarios.report',compact('usuarios'));
        }
    }
    public function create(){
        
        return view('usuarios.create',compact());
    }
    public function store (UsuariosFormRequest $request){
        try{
            $usuario=new Usuario;
            $usuario->nombre = $request->get('nombre');
            $usuario->nombre_usuario = $request->get('nombre_usuario');
            $usuario->password = $request->get('password');
            $usuario->email = $request->get('email');
            $usuario->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $usuario=Usuario::findOrFail($id);
        return view('usuarios.show',compact('usuario',));
    }
    public function edit($id){
        $usuario=Usuario::findOrFail($id);
        return view('usuarios.edit',compact('usuario',));
    }
    public function update(UsuariosFormRequest $request,$id){
        try{
            $usuario=Usuario::findOrFail($id);
    		$usuario->nombre = $request->get('nombre');
            $usuario->nombre_usuario = $request->get('nombre_usuario');
            $usuario->password = $request->get('password');
            $usuario->email = $request->get('email');
            $usuario->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('usuarios');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $usuario=Usuario::findOrFail($id);
            $usuario->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Usuario esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('usuarios');
    }
    
    
}
