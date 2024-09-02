<x-app-layout>

@if ($errors->any())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
	</div>
@endif

<p>
	LISTADO DE EMPLEADOS 2
	@include('empleados.create')
	
	<button class="btn btn-info" type="buton" data-toggle="modal" data-target="#empleadoCrear"> Nuevo</button>
	<table class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
		<thead>
			<th>ID</th>
			<th>NOMBRE</th>
			<th>EMAIL</th>
			<th>Acciones</th>
		</thead>
			@foreach($empleados as $empleado)
			<tr>
				<td>{{ $empleado->id }}</td>
				<td>{{ $empleado->nombre }}</td>
				<td>{{ $empleado->email }}</td>
				<td>
					<button type="button" data-target="#empleadoEditar{{$empleado->id}}" data-toggle="modal" class="btn btn-warning">Editar</button>

					<button type="button" data-target="#empleadoMostrar{{$empleado->id}}" data-toggle="modal" class="btn btn-info">Mostrar</button>

					<button type="button" data-target="#empleadoConfirmar{{$empleado->id}}" data-toggle="modal" class="btn btn-danger">Eliminar</button>
				</td>
			</tr>
			@include('empleados.editar')
			@include('empleados.mostrar')
			@include('empleados.confirmar')
			@endforeach
	</table>
</p>
</x-app-layout>