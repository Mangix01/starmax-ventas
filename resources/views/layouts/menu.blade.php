<a href="{{URL::action('App\Http\Controllers\DashboardControlador@dashboard')}}">
  <button class="btn btn-primary" style="margin-left: 20px; font-size: 12px;">
    <i class="fa fa-home"></i> {{ __('INICIO') }}
  </button>
</a>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-users"></i>
        <p class="font-weight-bold">
          {{ __('Sistema') }}
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-4">
        @can('index personas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\PersonasControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Personas</p>
            </a>
        </li>
        @endcan
       
        @can('index clientes')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ClientesControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Clientes</p>
            </a>
        </li>
        @endcan
        @can('index productos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProductosControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>Productos</p>
            </a>
        </li>
        @endcan
        @can('index proveedores')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>Proveedores</p>
            </a>
        </li>
        @endcan
        @can('index compras')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ComprasControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Compras</p>
            </a>
        </li>
        @endcan
        @can('index ventas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\VentasControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Ventas</p>
            </a>
        </li>
        @endcan
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fas fa-chart-bar"></i>
        <p class="font-weight-bold">
          {{ __('Reportes') }}
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-4">
        @can('report categorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Categorias</p>
            </a>
        </li>
        @endcan
        @can('report comprobantes')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ComprobantesControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Comprobantes</p>
            </a>
        </li>
        @endcan
        @can('report personas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\PersonasControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Personas</p>
            </a>
        </li>
        @endcan
        @can('report auditorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\AuditoriaControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Auditoria</p>
            </a>
        </li>
        @endcan
        @can('report clientes')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ClientesControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Clientes</p>
            </a>
        </li>
        @endcan
        @can('report productos')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProductosControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Productos</p>
            </a>
        </li>
        @endcan
        @can('report proveedores')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ProveedoresControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Proveedores</p>
            </a>
        </li>
        @endcan
        @can('report compras')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ComprasControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Compras</p>
            </a>
        </li>
        @endcan
        @can('report ventas')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\VentasControlador@report')}}" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Ventas</p>
            </a>
        </li>
        @endcan
        
    </ul>
</li>
@role('Admin')
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p class="font-weight-bold">
          {{ __('Configuración') }}
          <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-4">
        @can('index categorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorias</p>
            </a>
        </li>
        @endcan
        @can('index comprobantes')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\ComprobantesControlador@index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Comprobantes</p>
            </a>
        </li>
        @endcan
        
    </ul>
</li>
@endrole  
@canany(['index usuarios','index roles','index permisos'])
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-lock"></i>
        <p class="font-weight-bold">
            {{ __('Seguridad') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-4">
        @can('index usuarios')
        <li class="nav-item"> 
            <a class="nav-link" href="{{URL::action('App\Http\Controllers\UsersControlador@index')}}">
                <i class="nav-icon fa fa-users"></i>
                {{ __('Usuarios') }}
            </a>
        </li>
        @endcan
        @can('index roles')
        <li class="nav-item"> 
            <a class="nav-link" href="{{URL::action('App\Http\Controllers\RolesControlador@index')}}">
                <i class="nav-icon fas fa-user-circle"></i>
                {{ __('Roles') }}
            </a>
        </li>
        @endcan
        
         @can('index auditorias')
        <li class="nav-item">
            <a href="{{URL::action('App\Http\Controllers\AuditoriaControlador@index')}}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Auditoria</p>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan

<!-- <li>
  <a href="#">
    <i class="fa fa-plus-square"></i> <span>Ayuda</span>
    <small class="label pull-right bg-red">PDF</small>
  </a>
</li>
<li>
  <a href="#">
    <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
    <small class="label pull-right bg-yellow">IT</small>
  </a>
</li> 
@can('index permisos')
<li class="nav-item">
    <a href="{{URL::action('App\Http\Controllers\PermissionsControlador@index')}}" class="nav-link">
        <i class="nav-icon fas fa-lock"></i>
        Permisos
    </a>
</li>
@endcan
-->