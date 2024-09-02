<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Compra;
use App\Models\Detalle_compra;
// Modelos relacionados con Compra
use App\Models\Comprobante;
use App\Models\Proveedore;

// Modelos relacionados con Detalle_compra
use App\Models\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ComprasFormRequest;
use DB;
use Carbon\Carbon;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class ComprasControlador extends Controller
{
    public function __construct(){
        // $this->middleware('permission:list compras', ['only' => ['index']]);
        // $this->middleware('permission:create compras', ['only' => ['create','store']]);
        // $this->middleware('permission:edit compras', ['only' => ['edit','update']]);
        // $this->middleware('permission:delete compras', ['only' => ['destroy']]);
        // $this->middleware('permission:show compras', ['only' => ['show']]);
    }
    
    public function index(Request $request){
        $comprobantes=Comprobante::where('estado',true)->get();
        $proveedores=Proveedore::all();
        
        $productos=Producto::where('estado',true)->get(); 
        
        $hoy=Carbon::now();
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $compras=Compra::orderBy('id','desc')
                ->paginate(10);
            return view('compras.index',compact('hoy','compras','searchText','comprobantes','proveedores','productos',));
        }
    }
     public function report(Request $request){
        if ($request){
            $FechaIni=trim($request->get('FechaIni'));
            $FechaFin=trim($request->get('FechaFin'));
            $hoy=Carbon::now();
            $compras=Compra::whereBetween('fecha_recepcion', [$FechaIni, $FechaFin])
                ->paginate(1000);
            return view('compras.report',compact('hoy','compras','FechaIni','FechaFin'));
        }
    }
    public function create(){
		$comprobantes=Comprobante::where('estado',true)->get();
        $proveedores=Proveedore::all();
        
        $hoy=Carbon::now();
        $productos=Producto::where('estado',true)->get(); 
        return view('compras.create',compact('hoy','comprobantes','proveedores','productos',));
    }
    public function store (ComprasFormRequest $request){
        try{
            DB::beginTransaction();
            $compra=new Compra;
            $compra->fecha_recepcion = $request->get('fecha_recepcion');
            $compra->numero_comprobante = $request->get('numero_comprobante');
            $compra->estado = $request->get('estado');
            $compra->total = $request->get('total');
            $compra->idComprobante = $request->get('idComprobante');
            $compra->idProveedore = $request->get('idProveedore');
            $compra->save();

            //Toma los datos del arreglo del detalle_compras
            $idProducto=$request->get('aidProducto');
            $cantidad=$request->get('acantidad');
            $precio=$request->get('aprecio');
            $subtotal=$request->get('asubtotal');
            
            $i=0;   $total=0;
            while($i < count($idProducto)){
                $detalle_compras=new Detalle_Compra;
                //Toma los datos del arreglo del detalle_compras
                $detalle_compras->idCompra=$compra->id;
                $detalle_compras->idProducto=$idProducto[$i];
                $detalle_compras->cantidad=$cantidad[$i];
                $detalle_compras->precio=$precio[$i];
                $detalle_compras->subtotal=$subtotal[$i];
                $detalle_compras->subtotal = $detalle_compras->cantidad * $detalle_compras->precio;
                $detalle_compras->save();
                $total += $detalle_compras->subtotal;
                $i++;

                $producto  = Producto::findOrFail($detalle_compras->idProducto);
                if( $producto ){
                    $producto->precio_compra = $detalle_compras->precio;
                    $producto->stock = $producto->stock + $detalle_compras->cantidad;
                    $producto->update();
                }

            }
            if($compra->total !==$total){
                $compra->total = $total;
                $compra->update();
            }

            LogHelper::guardarLog('Registro de Compra','Se ha realizado una compra');

            DB::commit();
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('compras');
    }
    public function show($id){
        $compra=Compra::findOrFail($id);
        $comprobantes=Comprobante::where('estado',true)->get();
        $proveedores=Proveedore::all();
        $detalle_compras=Detalle_compra::where('idCompra',$id)
            ->get();
        return view('compras.show',compact('compra','detalle_compras','comprobantes','proveedores',));
    }
    public function edit($id){
        $compra=Compra::findOrFail($id);
        $comprobantes=Comprobante::where('estado',true)->get();
        $proveedores=Proveedore::all();
        $detalle_compras=Detalle_compra::where('idCompra',$id)
            ->get();
        $productos=Producto::where('estado',true)->get(); 
        
        return view('compras.edit',compact('compra','detalle_compras','detalle_compras','comprobantes','proveedores','productos',));
    }
    public function update(ComprasFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $compra=Compra::findOrFail($id);
            $compra->fecha_recepcion = $request->get('fecha_recepcion'); 
            $compra->numero_comprobante = $request->get('numero_comprobante'); 
            $compra->estado = $request->get('estado'); 
            $compra->total = $request->get('total'); 
            $compra->idComprobante = $request->get('idComprobante'); 
            $compra->idProveedore = $request->get('idProveedore'); 
            $compra->update();

            //Toma los datos del arreglo del detalle_compras
            $idProducto = $request->get('aidProducto');
            $cantidad = $request->get('acantidad');
            $precio = $request->get('aprecio');
            $subtotal = $request->get('asubtotal');
            
            $detalle_compras=DB::table('detalle_compras')
                ->where('idCompra',$id)
                ->get()
                ->keyBy('idProducto');

            $total = 0;
            foreach($idProducto as $key => $value){
                $subtotal[$key] = $cantidad[$key] * $precio[$key];
                $total += $subtotal[$key]; 
                $detalle = [
                    'idCompra' => $id,
                    'idProducto' => $idProducto[$key],
                    'cantidad' => $cantidad[$key],
                    'precio' => $precio[$key],
                    'subtotal' => $subtotal[$key],
                    
                ];
                if(isset($detalle_compras[$value])){
                   Detalle_compra::where('id',$detalle_compras[$value]->id)->update($detalle);
                   unset($detalle_compras[$value]);
                }else{ // si no existe lo agrega
                    Detalle_compra::create($detalle);
                }    
            }
            if( $detalle_compras->isNotEmpty()) {
                Detalle_compra::whereIn('id',$detalle_compras->pluck('id'))->delete(); 
            }
            if($compra->total !==$total){
                $compra->total = $total;
                $compra->update();
            }
            LogHelper::guardarLog('Actualización de Compra','Se ha modificado una compra');

            DB::commit();
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
             DB::rollback(); // en caso de error anulo transaccion
             toastr()->error(__('La actualización NO ha sido exitosa'));
        }
        return Redirect::to('compras');
    }
    public function destroy($id){
        try{
            DB::beginTransaction();
            // Borrar el detalle
            Detalle_compra::where('idCompra','=',$id)->delete();
            // Borra la cabecera
            Compra::findOrFail($id)->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }            
        return Redirect::to('compras');
    }
    public function cambiarEstado($id){
        $compra= Compra::findOrFail($id);
        $compra->estado = !$compra->estado;     // cambiar el estado de la compra
        $compra->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}