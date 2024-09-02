<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Personas</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Personas"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">TIPO PERSONA</th>
					<th class="text-center">RAZON SOCIAL</th>
					<th class="text-center">TIPO DOCUMENTO</th>
					<th class="text-center">NUMERO DOCUMENTO</th>
					<th class="text-center">DIRECCION</th>
					<th class="text-center">TELEFONO</th>
					<th class="text-center">EMAIL</th>
					<th class="text-center">ESTADO</th>
				</thead>
                @foreach ($personas as $persona)
					<tr>
						
						<td class="text-center">{{$persona->id}}</td>
						<td class="text-center">{{$persona->tipo_persona}}</td>
						<td class="text-center">{{$persona->razon_social}}</td>
						<td class="text-center">{{$persona->tipo_documento}}</td>
						<td class="text-center">{{$persona->numero_documento}}</td>
						<td class="text-center">{{$persona->direccion}}</td>
						<td class="text-center">{{$persona->telefono}}</td>
						<td class="text-center">{{$persona->email}}</td>
						<td class="text-center"><button class="btn @if ($persona->estado==1 or $persona->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($persona->estado==1 or $persona->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>
</x-app-layout>