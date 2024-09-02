<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Comprobante;
use App\Models\Persona;
use App\Models\Auditori;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Proveedore;
use App\Models\Compra;
use App\Models\Venta;

class DashboardControlador extends Controller
{
    public function __construct(){
        
    }
   
    public function dashboard(){
      
      $conteoCategorias=Categoria::count();
      $conteoComprobantes=Comprobante::count();
      $conteoPersonas=Persona::count();
      $conteoAuditorias=Auditori::count();
      $conteoClientes=Cliente::count();
      $conteoProductos=Producto::count();
      $conteoProveedores=Proveedore::count();
      $conteoCompras=Compra::count();
      $conteoVentas=Venta::count();
      return view('panel',compact('conteoCategorias','conteoComprobantes','conteoPersonas','conteoAuditorias','conteoClientes','conteoProductos','conteoProveedores','conteoCompras','conteoVentas',));
    }
       
}
