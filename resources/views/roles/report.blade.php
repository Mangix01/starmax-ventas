@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Roles</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Roles"; </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th>Rol</th>
					<!-- <th>Aplicación</th> -->
					<th>Created At</th>
					<th>Updated At</th>
				</thead>
                @foreach ($roles as $role)
					<tr>
						
						<td>{{$role->name}}</td>
						<!-- <td>{{$role->guard_name}}</td> -->
						<td>{{$role->created_at}}</td>
						<td>{{$role->updated_at}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$roles->render()}}
	</div>
</div>

@endsection