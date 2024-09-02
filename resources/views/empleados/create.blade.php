<div class="modal fade" id="empleadoCrear" tabindex="-1" role="dialog" aria-hidden="true" aria-labellebdy="modal_crear_Title">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
			  <h3>EMPLEADO NUEVO</h3>
			</div>

			<form action="empleados" method="POST">
				@csrf
				<div class="row">
					<div class="modal-body">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>email</label>
							<input type="email" name="email" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-info" type="submit">Grabar</button>
				</div>
			</form>
		</div>
	</div>
</div>