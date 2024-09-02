@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Users</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Users(s)"; </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Email</th>
					<th>Email Verified At</th>
					<th>Password</th>
					<th>Remember Token</th>
					<th>Created At</th>
					<th>Updated At</th>
				</thead>
               @foreach ($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->email_verified_at}}</td>
					<td>{{$user->password}}</td>
					<td>{{$user->remember_token}}</td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->updated_at}}</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$users->render()}}
	</div>
</div>

@endsection