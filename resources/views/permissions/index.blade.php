<x-app-layout>
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Listado de') }} Permisos</h3>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('permissions.create')
		<!-- @include('permissions.search') -->

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
	@can('create permisos')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_Permissions_Create">{{__('Nuevo')}}</button>
		</div>
	</div>
	@endcan
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header">
                <h3 class="card-title">Permissions</h3>
              </div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="listar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							
							<th class="text-center">ID</th>
							<th class="text-center">NAME</th>
							<!-- <th class="text-center">GUARD NAME</th> -->
							<th class="text-center">TABLA</th>
							<th class="text-center">{{__('Opciones')}}</th>
						</thead>
		                @foreach ($permissions as $permission)
							<tr>
								
								<td class="text-center">{{$permission->id}}</td>
								<td class="text-center">{{$permission->name}}</td>
								<!-- <td class="text-center">{{$permission->guard_name}}</td> -->
								<td class="text-center">{{$permission->tabla}}</td>
								<td class="d-flex justify-content-center">
									@can('edit permisos')
									<a href="" data-target="#modal-edit-{{$permission->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1">{{__('Editar')}}</button></a>
									@endcan
									@can('delete permisos')
									<a href="" data-target="#modal-delete-{{$permission->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1">{{__('Eliminar')}}</button></a>
			                        @endcan
			                        @can('show permisos')
			                        <a href="" data-target="#modal-ver-{{$permission->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1">{{__('Ver')}}</button></a>
			                        @endcan
			                        
								</td>
							</tr>
							@include('permissions.modal')
							@include('permissions.edit')
							@include('permissions.show')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $permissions->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>
</x-app-layout>