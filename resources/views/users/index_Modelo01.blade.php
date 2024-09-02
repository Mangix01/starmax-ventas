<x-app-layout>
<style>
.table-title {        
/*		padding-bottom: 15px;*/
		background: #435d7d;
/*		color: #fff;*/
/*		padding: 16px 30px;*/
/*		margin: -20px -25px 10px;*/
/*		border-radius: 3px 3px 0 0;*/
    }

</style>
@can('create users')
@include('users.create')
@endcan
<div class="row">
	<div class="col-lg-8">	
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
		@endif
	</div>
</div>
<div class="card">
    <div class="card-header table-title text-white">
    	<div class="row">
			<div class="col-lg-3">
				<h2>Listado de <b>Usuarios</b></h2>
			</div>
			<div class="col-lg-5">
			    <div class="search-box float-right">
			        <div class="input-group">
			            <input type="search" name="searchText" class="form-control" placeholder="{{ __('Buscar por Nombre') }}" value="{{$searchText}}" oninput="buscarDato(this.value);">
			            <div class="input-group-append">
			                <span class="input-group-text"><i class="fa fa-search"></i></span>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="col-lg-4 text-end">
				<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a> -->
				@can('create users')
				<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" data-target="#modal_Users_Create"><i class="material-icons">&#xE147;</i> <span>Agregar Usuario</span></a>
				@endcan
									
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<div class="table-wrapper">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<!-- <th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th> -->
							<th>Nombre</th>
							<th>Email</th>
							<th>Rol</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<!-- <td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td> -->
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->getRoleNames()->join(', ') }}</td>
							<td class="text-center"> 
                                <div class="btn-group">
									@can('edit users')
									<a class="btn-lg" href="#" class="edit" data-toggle="modal" data-toggle="tooltip" data-target="#modal-edit-{{$user->id}}" title="Editar este registro"><i class="fa fa-edit text-warning"></i></a>
									@endcan
									@can('delete users')
									<a class="btn-lg" href="#" class="delete" data-toggle="modal" data-toggle="tooltip" data-target="#modal-delete-{{$user->id}}" title="Eliminar este registro"><i class="fa fa-trash text-danger"></i></a>
									@endcan
									@can('show users')
			                        <a class="btn-lg" href="#" data-target="#modal-ver-{{$user->id}}" data-toggle="modal" title="Ver datos de este registro"><i class="fa fa-eye text-info"></i></a>
			                        @endcan
			                    </div>
							</td>
						</tr>
						@include('users.modal')
						@include('users.edit')
						@include('users.show')
						@endforeach
					</tbody>
				</table>
			</div>
		</div>        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
// $(document).ready(function(){
// 	// Activate tooltip
// 	$('[data-toggle="tooltip"]').tooltip();
	
// 	// Select/Deselect checkboxes
// 	var checkbox = $('table tbody input[type="checkbox"]');
// 	$("#selectAll").click(function(){
// 		if(this.checked){
// 			checkbox.each(function(){
// 				this.checked = true;                        
// 			});
// 		} else{
// 			checkbox.each(function(){
// 				this.checked = false;                        
// 			});
// 		} 
// 	});
// 	checkbox.click(function(){
// 		if(!this.checked){
// 			$("#selectAll").prop("checked", false);
// 		}
// 	});
// });
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