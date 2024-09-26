<x-app-layout>

<div class="container-lg">
	@if ($errors->any()) <!-- Instruccion de blade para mostrar todos los erroes de validadcion al usuario -->
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
	@endif
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="row">
                <div class="col-sm-6">
                    <h2> {{ __('Listado de') }} <b>Ventas</b></h2>
                </div>
                <div class="col-sm-5">
				    <div class="search-box float-right">
				        <div class="input-group">
				            <input type="text" name="searchText" id="searchx" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" onkeyup="buscarDato(this.value);">
				            <span class="input-group-addon mt-2"><i class="fa fa-search"></i></span>
				        </div>
				    </div>
				</div>
				@can('create ventas') <!-- Instruccion de blade para verificar los permisos del usuario -->
				<div class="col-sm-1">
					<div class="text-right">
						<a href="ventas/create" title="Registrar Ventas"><button class="btn btn-success shadow"><i class="fa fa-plus"></i></button></a>
					</div>
					
				</div>
				@endcan
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
						
						<th class="text-center">ID</th>
						<th class="text-center">FECHA VENTA</th>
						<th class="text-center">NUMERO COMPROBANTE</th>
						<th class="text-center">TOTAL</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">CLIENTE</th>
						<th class="text-center">COMPROBANTE</th>
						<th class="text-center">{{__('Acciones')}}</th>
					</thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            
							<td class="text-center">{{$venta->id}}</td>
							<td class="text-center">{{$venta->fecha_venta}}</td>
							<td class="text-center">{{$venta->numero_comprobante}}</td>
							<td class="text-center">{{$venta->total}}</td>
							<td class="text-center"><button class="btn @if ($venta->estado==1 or $venta->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($venta->estado==1 or $venta->estado=="active") Activo @else Inactivo @endif</button></td>
							<td class="text-center">{{$venta->cliente->persona->razon_social}}</td>
							<td class="text-center">{{$venta->comprobante->tipo_comprobante}}</td>
                            <td class="text-center"> 
                                <div class="btn-group">
                                    @can('edit ventas')
									<a href="{{URL::action('App\Http\Controllers\VentasControlador@edit',$venta->id)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class="fa fa-edit"></i></button></a>
									@endcan
									@can('destroy ventas')
									<a href="" data-target="#modal-delete-{{$venta->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1"><i class="fa fa-trash"></i></button></a>
			                        @endcan
			                        @can('show ventas')
			                        <a href="{{URL::action('App\Http\Controllers\VentasControlador@show',$venta->id)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class="fa fa-eye"></i></button></a>
			                        @endcan
						            @can('show ventas')
							        <a href="{{ route('ventas_pdf',$venta->id)}}" target="_blank" title="Ver datos de este registro"><button class="btn btn-danger btn-sm shadow mx-1">{{__('PDF')}}</button></a>
					                @endcan
			                        @can('edit ventas')
			                        <form action="/ventas/{{ $venta->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$venta->estado ? 'danger' : 'success'}} btn-sm shadow mx-1" type="submit">{{ $venta->estado ? __('Desactivar') : __('Activar') }}</button>
									</form>
									@endcan
                                </div>
                            </td>
                        </tr>
                        @include('ventas.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
           {{$ventas->render()}}
        </div>
    </div>        
</div> 

</x-app-layout>