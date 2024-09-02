<x-app-layout>

@include('comprobantes.create')
<div class="container-lg">
	@if ($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</div>
	@endif
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="row">
                <div class="col-sm-6">
                    <h2> {{ __('Listado de') }} <b>Comprobantes</b></h2>
                </div>
                <div class="col-sm-5">
				    <div class="search-box float-right">
				        <div class="input-group">
				            <input type="search" name="searchText" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" oninput="buscarDato(this.value);">
				            <div class="input-group-append">
				                <span class="input-group-text"><i class="fa fa-search"></i></span>
				            </div>
				        </div>
				    </div>
				</div>
				@can('create comprobantes')
				<div class="col-sm-1">
					<div class="text-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_Comprobantes_Create" title="Agregar mas registros"><i class="fa fa-plus"></i></button>
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
						<th class="text-center">TIPO COMPROBANTE</th>
						<th class="text-center">ESTADO</th>
						<th class="text-center">{{__('Acciones')}}</th>
					</thead>
                    <tbody>
                        @foreach ($comprobantes as $comprobante)
                        <tr>
                            
							<td class="text-center">{{$comprobante->id}}</td>
							<td class="text-center">{{$comprobante->tipo_comprobante}}</td>
							<td class="text-center"><button class="btn @if ($comprobante->estado==1 or $comprobante->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($comprobante->estado==1 or $comprobante->estado=="active") Activo @else Inactivo @endif</button></td>
                            <td class="text-center"> 
                                <div class="btn-group">
                                    @can('edit comprobantes')
									<a href="" data-target="#modal-edit-{{$comprobante->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class="fa fa-edit"></i></button></a>
									@endcan
									@can('destroy comprobantes')
									<a href="" data-target="#modal-delete-{{$comprobante->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1"><i class="fa fa-trash"></i></button></a>
			                        @endcan
			                        @can('show comprobantes')
			                        <a href="" data-target="#modal-ver-{{$comprobante->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class="fa fa-eye"></i></button></a>
			                        @endcan
			                        @can('edit comprobantes')
			                        <form action="/comprobantes/{{ $comprobante->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$comprobante->estado ? 'danger' : 'success'}} btn-sm shadow mx-1" type="submit">{{ $comprobante->estado ? __('Desactivar') : __('Activar') }}</button>
									</form>
									@endcan
                                </div>
                            </td>
                        </tr>
                        @include('comprobantes.modal')
						@include('comprobantes.edit')
						@include('comprobantes.show')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $comprobantes->links() }}
        </div>
    </div>        
</div> 

<script>
	function buscarDato(dato){
    	var term = dato.trim().toLowerCase();

        // Obtener todas las filas de la tabla
        var rows = document.querySelectorAll('table tbody tr');

        // Iterar sobre cada fila y realizar el filtrado en cualquier campo
        rows.forEach(function(row) {
            var found = false;
            // Iterar sobre cada celda de la fila
            row.querySelectorAll('td').forEach(function(cell) {
                var content = cell.textContent.trim().toLowerCase();
                // Verificar si el término de búsqueda está presente en el contenido de la celda
                if (content.includes(term)) {
                    found = true;
                }
            });
            // Mostrar o ocultar la fila según si se encontró el término de búsqueda en alguna celda
            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

</script>
<!-- <script>
	function buscarDato(dato){
	    	var term = dato.trim().toLowerCase();

	        // Obtener todas las filas de la tabla
	        var rows = document.querySelectorAll('table tbody tr');

	        // Iterar sobre cada fila y realizar el filtrado
	        rows.forEach(function(row) {
	            var name = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
	            if (name.includes(term)) {
	                row.style.display = '';
	            } else {
	                row.style.display = 'none';
	            }
	        });
	    }

</script> -->

</x-app-layout>