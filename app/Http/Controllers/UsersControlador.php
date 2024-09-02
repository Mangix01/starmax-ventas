<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use App\Http\Requests\UsersFormRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

use App\Helpers\LogHelper;

class UsersControlador extends Controller
{
    public function __construct(){

    }
    public static function middleware(): array
    {
        return [
            new Middleware('permission:list users', ['only' => ['index']]),
            new Middleware('permission:create users', ['only' => ['create','store']]),
            new Middleware('permission:edit users', ['only' => ['edit','update']]),
            new Middleware('permission:delete users', ['only' => ['destroy']]),
            new Middleware('permission:show users', ['only' => ['show']])
        ];
    }
    public function index(Request $request){
        $roles=DB::table('roles')->get();
        if ($request){
            $searchText=$request->get('searchText');
            $users=User::
                leftjoin('model_has_roles','model_has_roles.model_id','=','users.id')
                ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
                ->select('users.*','roles.id as rol_id','roles.name as rol_name')
                ->where('users.name','like','%'.$searchText.'%')
                ->orWhere('email','like','%'.$searchText.'%')
                ->orWhere('roles.name','like','%'.$searchText.'%')
                ->paginate(10);
            //dd($users);
            return view('users.index',["users"=>$users,"searchText"=>$searchText,'roles'=>$roles]);
        }
    }
    public function report(Request $request){
        $roles=DB::table('roles')->get();
        if ($request){
            $userss=User::paginate(100);
            return view('users.report',["userss"=>$userss,'roles'=>$roles]);
        }
    }
    public function create(){
        $hoy=Carbon::now();
        $roles=DB::table('roles')->get();
        return view("users.create",compact('roles','hoy'));
    }
    public function store (UsersFormRequest $request){
        try{
            $user=new User;
            $user->name=$request->get('name');
            $user->email=$request->get('email');
            $user->password=bcrypt($request->get('password'));
            //$users->remember_token=$request->get('remember_token');
            $user->save();

                   
            $rol=DB::table('roles')->where('id',$request->get('idrol'))->value('name');
            $user->assignRole($rol);
            
             LogHelper::guardarLog('Crea Usuario','Se ha creado un nuevo Usuario');

            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //dd( $e->getMessage());
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('users');
    }
    public function show($id){
        $user=User::findOrFail($id);
        $roles=DB::table('roles')->get();
        return view("users.showOk",["user"=>$user,'roles' => $roles]);
    }
    public function edit($id){
        $user=User::
            leftJoin('model_has_roles','model_id','=','users.id')
            ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
            ->where('users.id',$id)
            ->select('users.*','roles.id as rol_id','roles.name as rol_name')
            ->first();
        $roles=DB::table('roles')->get();
        return view("users.editOk",compact('user','roles'));
    }

    public function update(UsersFormRequest $request,$id){
        try{
            $user=User::findOrFail($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if($user->password!==$request->get('password'))
                $user->password = bcrypt($request->get('password'));
            //$user->remember_token = $request->get('remember_token');
            $rol_id_Anterior=DB::table('model_has_roles')->where('model_id',$user->id)->value('role_id');
            $rolAnterior=DB::table('roles')->where('id',$rol_id_Anterior)->value('name');
            $user->update();

            $rolNuevo=DB::table('roles')->where('id',$request->get('idrol'))->value('name');
            
            if($rolAnterior)
                $user->removeRole($rolAnterior);
            $user->assignRole($rolNuevo);

             LogHelper::guardarLog('Actualiza Usuario','Se ha actualizado un Usuario');
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('users');
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            $user=User::findOrFail($id);
            $user->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('users');
    }
}
