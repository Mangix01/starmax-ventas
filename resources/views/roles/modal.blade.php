<div class="modal fade" id="modal-delete-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ action('App\Http\Controllers\RolesControlador@destroy', $role->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header colorModal">
          <h4 class="modal-title" id="exampleModalLabel">{{__('Eliminar')}} Rol</h4>
          <button type="button" class="btn btn-close btn-danger pull-right" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          <p>Confirme si desea Eliminar Rol</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cerrar')}}</button>
  		<button type="submit" class="btn btn-primary">{{__('Confirmar')}}</button>
        </div>
      </div>
    </div>
  </form>
</div>