<x-app-layout>

<div class="container-lg">
	@if ($errors->any())
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
                    <h2> {{ __('Listado de') }} <b>Compras</b></h2>
                </div>
                <div class="col-sm-5">
				    <div class="search-box float-right">
				        <div class="input-group">
				            <input type="text" name="searchText" id="searchx" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" onkeyup="buscarDato(this.value);">
				            <span class="input-group-addon mt-2"><i class="fa fa-search"></i></span>
				        </div>
				    </div>
				</div>
				@can('create compras')
				<div class="col-sm-1">
					<div class="text-right">
						<a href="compras/create" title="Registrar Compras"><button class="btn btn-success shadow"><i class="fa fa-plus"></i></button></a>
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
						<th class="text-center">FECHA RECEPCION</th>
						<th class="text-center">NUMERO COMPROBANTE</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">TOTAL</th>
						<th class="text-center">COMPROBANTE</th>
						<th class="text-center">PROVEEDOR</th>
						<th class="text-center">{{__('Acciones')}}</th>
					</thead>
                    <tbody>
                        @foreach ($compras as $compra)
                        <tr>
                            
							<td class="text-center">{{$compra->id}}</td>
							<td class="text-center">{{$compra->fecha_recepcion}}</td>
							<td class="text-center">{{$compra->numero_comprobante}}</td>
							<td class="text-center"><button class="btn @if ($compra->estado==1 or $compra->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($compra->estado==1 or $compra->estado=="active") Activo @else Inactivo @endif</button></td>
							<td class="text-center">{{$compra->total}}</td>
							<td class="text-center">{{$compra->comprobante->tipo_comprobante}}</td>
							<td class="text-center">{{$compra->proveedore->persona->razon_social}}</td>
                            <td class="text-center"> 
                                <div class="btn-group">
                                    @can('edit compras')
									<a href="{{URL::action('App\Http\Controllers\ComprasControlador@edit',$compra->id)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class="fa fa-edit"></i></button></a>
									@endcan
									@can('destroy compras')
									<a href="" data-target="#modal-delete-{{$compra->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1"><i class="fa fa-trash"></i></button></a>
			                        @endcan
			                        @can('show compras')
			                        <a href="{{URL::action('App\Http\Controllers\ComprasControlador@show',$compra->id)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class="fa fa-eye"></i></button></a>
			                        @endcan
			                        @can('edit compras')
			                        <form action="/compras/{{ $compra->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$compra->estado ? 'danger' : 'success'}} btn-sm shadow mx-1" type="submit">{{ $compra->estado ? __('Desactivar') : __('Activar') }}</button>
									</form>
									@endcan
                                </div>
                            </td>
                        </tr>
                        @include('compras.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>        
</div> 

</x-app-layout>