<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Documentos</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Documentos"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">TIPO DOCUMENTO</th>
					<th class="text-center">NUMERO DOCUMENTO</th>
				</thead>
                @foreach ($documentos as $documento)
					<tr>
						
						<td class="text-center">{{$documento->id}}</td>
						<td class="text-center">{{$documento->tipo_documento}}</td>
						<td class="text-center">{{$documento->numero_documento}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$documentos->render()}}
	</div>
</div>
</x-app-layout>