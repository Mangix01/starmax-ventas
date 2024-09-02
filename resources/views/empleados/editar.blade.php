<div class="modal fade" id="empleadoEditar{{$empleado->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labellebdy="modal_mostrar_Title">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
			  <h3>EDITAR EMPLEADO </h3>
			</div>

			<form action="{{ route('empleados.update', $empleado->id)}}" method="POST">
				@method('PATCH')
				@csrf
				<div class="row">
					<div class="modal-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control" value="{{ $empleado->nombre }}" >
						</div>
						<div class="form-group">
							<label>email</label>
							<input type="text" name="email" class="form-control" value="{{ $empleado->email }}" >
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-info" type="submit">Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>