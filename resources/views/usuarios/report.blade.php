<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Usuarios</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Usuarios"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">NOMBRE</th>
					<th class="text-center">NOMBRE USUARIO</th>
					<th class="text-center">PASSWORD</th>
					<th class="text-center">EMAIL</th>
				</thead>
                @foreach ($usuarios as $usuario)
					<tr>
						
						<td class="text-center">{{$usuario->id}}</td>
						<td class="text-center">{{$usuario->nombre}}</td>
						<td class="text-center">{{$usuario->nombre_usuario}}</td>
						<td class="text-center">{{$usuario->password}}</td>
						<td class="text-center">{{$usuario->email}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$usuarios->render()}}
	</div>
</div>
</x-app-layout>