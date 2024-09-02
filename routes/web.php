<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Sistema
    Route::middleware(['dynamic.permission'])->group(function () {
        Route::resource('categorias','App\Http\Controllers\CategoriasControlador');
        Route::post('categorias/{id}/estado','App\Http\Controllers\CategoriasControlador@cambiarEstado')->middleware('permission:edit categorias');
        Route::resource('comprobantes','App\Http\Controllers\ComprobantesControlador');
        Route::post('comprobantes/{id}/estado','App\Http\Controllers\ComprobantesControlador@cambiarEstado')->middleware('permission:edit comprobantes');
        Route::resource('personas','App\Http\Controllers\PersonasControlador');
        Route::post('personas/{id}/estado','App\Http\Controllers\PersonasControlador@cambiarEstado')->middleware('permission:edit personas');
        Route::resource('auditoria','App\Http\Controllers\AuditoriaControlador');
        Route::resource('clientes','App\Http\Controllers\ClientesControlador');
        Route::resource('productos','App\Http\Controllers\ProductosControlador');
        Route::post('productos/{id}/estado','App\Http\Controllers\ProductosControlador@cambiarEstado')->middleware('permission:edit productos');
        Route::resource('proveedores','App\Http\Controllers\ProveedoresControlador');
        Route::resource('compras','App\Http\Controllers\ComprasControlador');
        Route::post('compras/{id}/estado','App\Http\Controllers\ComprasControlador@cambiarEstado')->middleware('permission:edit compras');
        Route::resource('ventas','App\Http\Controllers\VentasControlador');
        Route::post('ventas/{id}/estado','App\Http\Controllers\VentasControlador@cambiarEstado')->middleware('permission:edit ventas');
        
    });

    Route::middleware('role:Admin')->group(function () {
        Route::resource('roles','App\Http\Controllers\RolesControlador');
        Route::resource('users','App\Http\Controllers\UsersControlador');
        Route::resource('permissions','App\Http\Controllers\PermissionsControlador');
    });

    //Reportes
    Route::get('categorias_report','App\Http\Controllers\CategoriasControlador@report')->middleware('permission:report categorias');
    Route::get('comprobantes_report','App\Http\Controllers\ComprobantesControlador@report')->middleware('permission:report comprobantes');
    Route::get('personas_report','App\Http\Controllers\PersonasControlador@report')->middleware('permission:report personas');
    Route::get('auditoria_report','App\Http\Controllers\AuditoriaControlador@report')->middleware('permission:report auditorias');
    Route::get('clientes_report','App\Http\Controllers\ClientesControlador@report')->middleware('permission:report clientes');
    Route::get('productos_report','App\Http\Controllers\ProductosControlador@report')->middleware('permission:report productos');
    Route::get('proveedores_report','App\Http\Controllers\ProveedoresControlador@report')->middleware('permission:report proveedores');
    Route::get('compras_report','App\Http\Controllers\ComprasControlador@report')->middleware('permission:report compras');
    Route::get('ventas_report','App\Http\Controllers\VentasControlador@report')->middleware('permission:report ventas');
    
    Route::get('roles_report','App\Http\Controllers\RolesControlador@report')->middleware('permission:report roles');
    Route::get('users_report','App\Http\Controllers\UsersControlador@report')->middleware('permission:report users');
    Route::get('permissions_report','App\Http\Controllers\PermissionsControlador@report')->middleware('permission:report permissions');

    // Dashboards
    Route::get('panel','App\Http\Controllers\DashboardControlador@dashboard')->middleware('auth');
    Route::get('dashboard','App\Http\Controllers\DashboardControlador@dashboard')->middleware('auth')->name('dashboard');

    // Otros Rutas
    Route::get('ventas_pdf/{id}','App\Http\Controllers\VentasControlador@pdf')->middleware('permission:show ventas')->name('ventas_pdf');
    

    // Importar
    

    // Calendario
    
    Route::resource('empleados','App\Http\Controllers\EmpleadosControlador');
});
// Route::auth();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');