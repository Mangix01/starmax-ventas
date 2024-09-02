<x-app-layout>
<!-- Content Header (Page header) -->

@php
$colors = ['bg-success','bg-info','bg-danger','bg-warning'];
$dashboardItems = [
    ['permission' => 'dashboard personas', 'count' => $conteoPersonas, 'label' => 'Personas', 'controller' => 'PersonasControlador@index', 'icon' => 'fa-users'],
    ['permission' => 'dashboard auditorias', 'count' => $conteoAuditorias, 'label' => 'Auditorias', 'controller' => 'AuditoriaControlador@index', 'icon' => 'fa-file-alt'],
    ['permission' => 'dashboard clientes', 'count' => $conteoClientes, 'label' => 'Clientes', 'controller' => 'ClientesControlador@index', 'icon' => 'fa-user-tie'],
    ['permission' => 'dashboard productos', 'count' => $conteoProductos, 'label' => 'Productos', 'controller' => 'ProductosControlador@index', 'icon' => 'fa-box'],
    ['permission' => 'dashboard proveedores', 'count' => $conteoProveedores, 'label' => 'Proveedores', 'controller' => 'ProveedoresControlador@index', 'icon' => 'fa-truck'],
    ['permission' => 'dashboard compras', 'count' => $conteoCompras, 'label' => 'Compras', 'controller' => 'ComprasControlador@index', 'icon' => 'fa-shopping-cart'],
    ['permission' => 'dashboard ventas', 'count' => $conteoVentas, 'label' => 'Ventas', 'controller' => 'VentasControlador@index', 'icon' => 'fa-cash-register'],
];
@endphp

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboards VENTAS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="row">
  
  @foreach ($dashboardItems as $key => $item)
    @can($item['permission'])
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box {{$colors[$key % 4]}}">
                <div class="inner">
                    <h3 class="text-center">{{$item['count']}}</h3>
                    <p class="text-center">{{$item['label']}}</p>
                </div>
                <div class="icon">
                    <i class="fas {{$item['icon']}}"></i>
                </div>
                <a href="{{URL::action('App\Http\Controllers\\' . $item['controller'])}}" class="small-box-footer">{{ __('Mas info') }} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endcan
@endforeach
</div>
</x-app-layout>
