<div class="modal fade" id="modal-delete-{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ action('App\Http\Controllers\VentasControlador@destroy', $venta->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header colorModal">
          <h4 class="modal-title" id="exampleModalLabel">{{__('Eliminar')}} Venta</h4>
          <button type="button" class="btn btn-close btn-danger" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          <p>{{ __('Confirme si desea Eliminar') }} Venta</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cerrar')}}</button>
  		<button type="submit" class="btn btn-primary">{{__('Confirmar')}}</button>
        </div>
      </div>
    </div>
  </form>
</div>