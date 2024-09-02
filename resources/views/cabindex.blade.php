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
                    <h2> {{ __('Listado de') }} <b>|Tabla_SinGuion|</b></h2>
                </div>
                <div class="col-sm-5">
				    <div class="search-box float-right">
				        <div class="input-group">
				            <input type="text" name="searchText" id="searchx" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" onkeyup="buscarDato(this.value);">
				            <span class="input-group-addon mt-2"><i class="fa fa-search"></i></span>
				        </div>
				    </div>
				</div>
				|can_create|
				<div class="col-sm-1">
					<div class="text-right">
						<a href="|tabla|/create" title="Registrar |Tabla_SinGuion|"><button class="btn btn-success shadow"><i class="fa fa-plus"></i></button></a>
					</div>
					|Laravel_accion_import_excel|
				</div>
				|fin_can|
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
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
									<a href="{{URL::action('App\Http\Controllers\|Tabla|Controlador@edit',$|tabla_singular|->|primaryKey|)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class="fa fa-edit"></i></button></a>
									|fin_can|
									|can_delete|
									<a href="" data-target="#modal-delete-{{$|tabla_singular|->|primaryKey|}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1"><i class="fa fa-trash"></i></button></a>
			                        |fin_can|
			                        |can_show|
			                        <a href="{{URL::action('App\Http\Controllers\|Tabla|Controlador@show',$|tabla_singular|->|primaryKey|)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class="fa fa-eye"></i></button></a>
			                        |fin_can||Laravel_accion_pdf|
			                        |activarDesactivarEstadoVista|
                                </div>
                            </td>
                        </tr>
                        @include('|tabla|.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>        
</div> 

<script>
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

</script>

</x-app-layout>