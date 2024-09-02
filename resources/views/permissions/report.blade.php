@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Permissions</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Permissions"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">NAME</th>
					<!-- <th class="text-center">GUARD NAME</th> -->
					<th class="text-center">TABLA</th>
				</thead>
                @foreach ($permissions as $permission)
					<tr>
						
						<td class="text-center">{{$permission->id}}</td>
						<td class="text-center">{{$permission->name}}</td>
						<!-- <td class="text-center">{{$permission->guard_name}}</td> -->
						<td class="text-center">{{$permission->tabla}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$permissions->render()}}
	</div>
</div>

@endsection