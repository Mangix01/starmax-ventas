<x-app-layout>
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios<a href="users/create"></a></h3>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@can('create usuarios')
		@include('users.create')
		@endcan
		@include('users.search')

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
	@can('create usuarios')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
	 		<button type="button" class="btn btn-success shadow" data-toggle="modal" data-target="#modal_Users_Create">{{__('Nuevo')}}</button>
		</div>
	</div>
	@endcan
</div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover table-sm">
						<thead>
							<th>Nombre</th>
							<th>Email</th>
							<th>Rol</th>
							<th class="text-center">{{__('Opciones')}}</th>
						</thead>
		               @foreach ($users as $user)
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->getRoleNames()->join(', ') }}</td>
							<td class="text-center">
								@can('edit usuarios')
								<a href="" data-target="#modal-edit-{{$user->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-info btn-sm shadow">{{__('Editar')}}</button></a>
								@endcan
								@can('delete usuarios')
		                        <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow">{{__('Eliminar')}}</button></a>
		                        @endcan
		                        @can('show usuarios')
		                        <a href="" data-target="#modal-ver-{{$user->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-success btn-sm shadow">{{__('Ver')}}</button></a>
		                        @endcan
							</td>
						</tr>
						@include('users.modal')
						@include('users.edit')
						@include('users.show')
						@endforeach
					</table>
				</div>
				{{$users->render()}}
			</div>
		</div>
	</div>
</div>
</x-app-layout>