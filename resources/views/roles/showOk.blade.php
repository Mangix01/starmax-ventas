@extends ('layouts.admin')
@section ('contenido')

@can('show roles')
@include('roles.show')
@endcan

<script>
    $(document).ready(function() {
        $('#modal-ver-{{$role->id}}').modal('show');
    });
</script>

@endsection