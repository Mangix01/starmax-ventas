<x-app-layout>
<style>
	.table-title {        
    	background: #435d7d;
  	}
</style>
|can_create|
@include('|tabla|.create')
|fin_can|
<div class="container-lg">
	@if ($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</div>
	@endif
    <div class="card">
        <div class="card-header table-title text-white">
            <div class="row">
                <div class="col-lg-6">
                    <h2> {{ __('Listado de') }} <b>|Tabla_SinGuion|</b></h2>
                </div>
                <div class="col-lg-4">
				    <div class="search-box float-right">
				        <div class="input-group">
				            <input type="search" name="searchText" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" oninput="buscarDato(this.value);">
				            <div class="input-group-append">
				                <span class="input-group-text"><i class="fa fa-search"></i></span>
				            </div>
				        </div>
				    </div>
				</div>
				|can_create|
				<div class="col-lg-2 text-end">
					<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal_|Tabla|_Create" title="Agregar mas registros"><i class="material-icons">&#xE147;</i> <span>Agregar |Tabla_Singular_Label|</span></a>
					|Laravel_accion_import_excel|
				</div>
				|fin_can|
				|Laravel_accion_calendario|
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
            	<div class="table-wrapper">
	                <table class="table table-striped table-hover">
	                    <thead>
							|ParrafoRepetirCampo_ParaListar|
							<th class="text-center">|CampoLabel|</th>|FinParrafoRepetirCampo_ParaListar|
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
	                    <tbody>
	                        @foreach ($|tabla| as $|tabla_singular|)
	                        <tr>
	                            |ParrafoRepetirCampo_ParaListar|
								<td class="text-center">{{$|tabla_singular|->|campoConRefLav|}}</td>|FinParrafoRepetirCampo_ParaListar|
	                            <td class="text-center"> 
	                                <div class="btn-group">
	                                    |can_edit|
										<a class="btn btn-warning btn-sm shadow mx-1" href="" data-target="#modal-edit-{{$|tabla_singular|->|primaryKey|}}" data-toggle="modal" title="Editar datos de este registro"><i class="fa fa-edit text-white"></i></a>
										|fin_can|
										|can_delete|
										<a class="btn btn-danger btn-sm shadow mx-1" href="" data-target="#modal-delete-{{$|tabla_singular|->|primaryKey|}}" data-toggle="modal" title="Eliminar este registro"><i class="fa fa-trash text-white"></i></a>
				                        |fin_can|
				                        |can_show|
				                        <a class="btn btn-info btn-sm shadow mx-1" href="" data-target="#modal-ver-{{$|tabla_singular|->|primaryKey|}}" data-toggle="modal" title="Ver datos de este registro"><i class="fa fa-eye text-white"></i></a>
				                        |fin_can||Laravel_accion_pdf|
				                        |activarDesactivarEstadoVista|
	                                </div>
	                            </td>
	                        </tr>
	                        @include('|tabla|.modal')
							@include('|tabla|.edit')
							@include('|tabla|.show')
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
            </div>
            {{ $|tabla|->links() }}
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
</x-app-layout>
