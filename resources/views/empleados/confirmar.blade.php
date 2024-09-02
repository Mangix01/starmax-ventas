<div class="modal fade" id="empleadoConfirmar{{$empleado->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labellebdy="modal_mostrar_Title">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
			  <h3>CONFIRMACIÓN DE ELIMINACIÓN DE  EMPLEADO </h3>
			</div>

			<form action="{{ route('empleados.destroy', $empleado->id)}}" method="POST">
				@method('DELETE')
				@csrf
				<div class="row">
					<div class="modal-body">
						<p>Confirme eliminación de empleado: {{$empleado->nombre}}</p>
					</div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-info" type="submit">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>