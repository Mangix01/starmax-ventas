<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\Detalle_venta;
// Modelos relacionados con Venta
use App\Models\Cliente;
use App\Models\Comprobante;

// Modelos relacionados con Detalle_venta
use App\Models\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VentasFormRequest;
use DB;

use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Barryvdh\DomPDF\Facade\Pdf;

class VentasControlador extends Controller
{
    public function __construct(){
        // $this->middleware('permission:list ventas', ['only' => ['index']]);
        // $this->middleware('permission:create ventas', ['only' => ['create','store']]);
        // $this->middleware('permission:edit ventas', ['only' => ['edit','update']]);
        // $this->middleware('permission:delete ventas', ['only' => ['destroy']]);
        // $this->middleware('permission:show ventas', ['only' => ['show']]);
    }
    
    public function index(Request $request){
        $clientes=Cliente::all();
        $comprobantes=Comprobante::where('estado',true)->get();
        
        $productos=Producto::where('estado',true)->get(); 
        
        
        if ($request){
            $searchText=''; //trim($request->get('searchText'));
            $ventas=Venta::orderBy('id','desc')
                ->paginate(10);
            return view('ventas.index',compact('ventas','searchText','clientes','comprobantes','productos',));
        }
    }
     public function report(Request $request){
        if ($request){
            $FechaIni=trim($request->get('FechaIni'));
            $FechaFin=trim($request->get('FechaFin'));
            
            // Convertir las fechas a objetos Carbon para manipularlas más fácilmente
            $FechaIn = \Carbon\Carbon::parse($FechaIni)->startOfDay();
            $FechaFi = \Carbon\Carbon::parse($FechaFin)->endOfDay();

            $ventas=Venta::whereBetween('fecha_venta', [$FechaIn, $FechaFi])
                ->paginate(1000);
            return view('ventas.report',compact('ventas','FechaIni','FechaFin'));
        }
    }
    public function report01(Request $request){
        // if ($request){
        //     $FechaIni=trim($request->get('FechaIni'));
        //     $FechaFin=trim($request->get('FechaFin'));
            
        //     // Convertir las fechas a objetos Carbon para manipularlas más fácilmente
        //     $FechaIn = \Carbon\Carbon::parse($FechaIni)->startOfDay();
        //     $FechaFi = \Carbon\Carbon::parse($FechaFin)->endOfDay();

        //     $ventas=Venta::whereBetween('fecha_venta', [$FechaIn, $FechaFi])
        //         ->paginate(1000);
        //     return view('ventas.report01',compact('ventas','FechaIni','FechaFin'));
        // }
        $clientes=Cliente::all();
        $productos=Producto::where('estado',true)->get(); 
        $FechaIni=trim($request->get('FechaIni'));
        $FechaFin=trim($request->get('FechaFin'));

        $query = Venta::with(['cliente', 'detalle_venta.producto']);

        // Filtrar por razón social
        if ($request->filled('razon_social')) {
            $query->whereHas('cliente.persona', function($q) use ($request) {
                $q->where('razon_social', $request->razon_social);
            });
        }

        // Filtrar por producto
        if ($request->filled('producto')) {
            $query->whereHas('detalle_venta.producto', function($q) use ($request) {
                $q->where('idProducto', $request->producto);
            });
        }

        // Filtrar por rango de fechas
        if ($request->filled('FechaIni') && $request->filled('FechaFin')) {
            $fechaInicio = Carbon::parse($request->FechaIni)->startOfDay();
            $fechaFin = Carbon::parse($request->FechaFin)->endOfDay();
            
            $query->whereBetween('fecha_venta', [$fechaInicio, $fechaFin]);
        }

        $ventas = $query->get();
        // dd($ventas);
        return view('ventas.report01', compact('ventas','FechaIni','FechaFin','clientes','productos','request'));
    }
    public function report02(Request $request){
        $query = Venta::with(['cliente', 'detalle_venta.producto']);

        // Filtros
         if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
            
            $query->whereBetween('fecha_venta', [$fechaInicio, $fechaFin]);
        }

        // Filtrar por razón social
        if ($request->filled('razon_social')) {
            $query->whereHas('cliente.persona', function($q) use ($request) {
                $q->where('razon_social', $request->razon_social);
            });
        }

        if ($request->producto) {
            $query->whereHas('detalle_venta.producto', function($q) use ($request) {
                $q->where('id', $request->producto);
            });
        }

        if ($request->name) {
            $query->where('usuario', $request->name);
        }

        if ($request->has('estado') && $request->estado !== '' && $request->estado !== null) {
            $query->where('estado', $request->estado);
        }


        if ($request->idCategoria) {
            $query->whereHas('detalle_venta.producto.categoria', function($q) use ($request) {
                $q->where('idCategoria', $request->idCategoria);
            });
        }

        $ventas = $query->get();
        // dd($fechaInicio,$fechaFin,$ventas,$request->estado);
        // Obtener datos para los filtros
        $clientes = Cliente::all();
        $productos = Producto::where('estado',true)->get();;
        $categorias=Categoria::where('estado',true)->get();
        $usuarios = User::select('id','name')->get();

        return view('ventas.report02', compact('ventas', 'clientes', 'productos','request','categorias','usuarios'));
    }
    public function create(){
		$clientes=Cliente::all();
        $comprobantes=Comprobante::where('estado',true)->get();
        
        
        $productos=Producto::where('estado',true)->get(); 
        return view('ventas.create',compact('clientes','comprobantes','productos',));
    }
    public function store (VentasFormRequest $request){
        try{
            DB::beginTransaction();
            $venta=new Venta;
            $venta->numero_comprobante = $request->get('numero_comprobante');
            $venta->total = $request->get('total');
            $venta->estado = $request->get('estado');
            $venta->idCliente = $request->get('idCliente');
            $venta->idComprobante = $request->get('idComprobante');
            $venta->save();

            //Toma los datos del arreglo del detalle_ventas
            $idProducto=$request->get('aidProducto');
            $cantidad=$request->get('acantidad');
            $precio=$request->get('aprecio');
            $descuento=$request->get('adescuento');
            $subtotal=$request->get('asubtotal');
            
            $i=0;   $total=0;
            while($i < count($idProducto)){
                $detalle_ventas=new Detalle_Venta;
                //Toma los datos del arreglo del detalle_ventas
                $detalle_ventas->idVenta=$venta->id;
                $detalle_ventas->idProducto=$idProducto[$i];
                $detalle_ventas->cantidad=$cantidad[$i];
                $detalle_ventas->precio=$precio[$i];
                $detalle_ventas->descuento=$descuento[$i];
                $detalle_ventas->subtotal=$subtotal[$i];
                //$detalle_ventas->subtotal = ($detalle_ventas->cantidad * $detalle_ventas->precio) - $detalle_ventas->descuento;
                $detalle_ventas->subtotal = ($detalle_ventas->cantidad * $detalle_ventas->precio) - (($detalle_ventas->cantidad * $detalle_ventas->precio) * ($detalle_ventas->descuento / 100));
                $detalle_ventas->save();

                $producto  = Producto::findOrFail($detalle_ventas->idProducto);
                if( $producto ){
                    $producto->stock = $producto->stock - $detalle_ventas->cantidad;
                    $producto->update();
                }

                $total += $detalle_ventas->subtotal;
                $i++;
            }
            if($venta->total !==$total){
                $venta->total = $total;
                $venta->update();
            }

            LogHelper::guardarLog('Registro de Venta','Se ha realizado una venta');

            DB::commit();
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('ventas');
    }
    public function show($id){
        $venta=Venta::findOrFail($id);
        $clientes=Cliente::all();
        $comprobantes=Comprobante::where('estado',true)->get();
        $detalle_ventas=Detalle_venta::where('idVenta',$id)
            ->get();
        return view('ventas.show',compact('venta','detalle_ventas','clientes','comprobantes',));
    }
    public function edit($id){
        $venta=Venta::findOrFail($id);
        $clientes=Cliente::all();
        $comprobantes=Comprobante::where('estado',true)->get();
        $detalle_ventas=Detalle_venta::where('idVenta',$id)
            ->get();
        $productos=Producto::where('estado',true)->get(); 
        
        return view('ventas.edit',compact('venta','detalle_ventas','detalle_ventas','clientes','comprobantes','productos',));
    }
    public function update(VentasFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $venta=Venta::findOrFail($id);
            $venta->numero_comprobante = $request->get('numero_comprobante'); 
            $venta->total = $request->get('total'); 
            $venta->estado = $request->get('estado'); 
            $venta->idCliente = $request->get('idCliente'); 
            $venta->idComprobante = $request->get('idComprobante'); 
            $venta->update();

            //Toma los datos del arreglo del detalle_ventas
            $idProducto = $request->get('aidProducto');
            $cantidad = $request->get('acantidad');
            $precio = $request->get('aprecio');
            $descuento = $request->get('adescuento');
            $subtotal = $request->get('asubtotal');
            
            $detalle_ventas=DB::table('detalle_ventas')
                ->where('idVenta',$id)
                ->get()
                ->keyBy('idProducto');

            $total = 0;
            foreach($idProducto as $key => $value){
                $subtotal[$key] = $cantidad[$key] * $precio[$key];
                $total += $subtotal[$key]; 
                $detalle = [
                    'idVenta' => $id,
                    'idProducto' => $idProducto[$key],
                    'cantidad' => $cantidad[$key],
                    'precio' => $precio[$key],
                    'descuento' => $descuento[$key],
                    'subtotal' => $subtotal[$key],
                    
                ];
                if(isset($detalle_ventas[$value])){
                   Detalle_venta::where('id',$detalle_ventas[$value]->id)->update($detalle);
                   unset($detalle_ventas[$value]);
                }else{ // si no existe lo agrega
                    Detalle_venta::create($detalle);
                }    
            }
            if( $detalle_ventas->isNotEmpty()) {
                Detalle_venta::whereIn('id',$detalle_ventas->pluck('id'))->delete(); 
            }
            if($venta->total !==$total){
                $venta->total = $total;
                $venta->update();
            }
            LogHelper::guardarLog('Actualización de Venta','Se ha modificado una venta');

            DB::commit();
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
             DB::rollback(); // en caso de error anulo transaccion
             toastr()->error(__('La actualización NO ha sido exitosa'));
        }
        return Redirect::to('ventas');
    }
    public function destroy($id){
        try{
            DB::beginTransaction();
            // Borrar el detalle
            Detalle_venta::where('idVenta','=',$id)->delete();
            // Borra la cabecera
            Venta::findOrFail($id)->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }            
        return Redirect::to('ventas');
    }
    public function pdf($id){
        set_time_limit(600);
        $venta=Venta::findOrFail($id);
        $detalle_ventas=Detalle_venta::where('idVenta',$id)->get();
        $pdf = Pdf::loadView('ventas.pdf', ['venta' => $venta ,'detalle_ventas' => $detalle_ventas] );
        $pdf->setPaper('A5', 'portrait');
        return $pdf->stream();

    }

    public function cambiarEstado($id){
        $venta= Venta::findOrFail($id);
        $venta->estado = !$venta->estado;     // cambiar el estado de la venta
        $venta->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}