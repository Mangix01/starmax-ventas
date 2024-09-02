<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Comprobantes</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Comprobantes"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">TIPO COMPROBANTE</th>
					<th class="text-center">ESTADO</th>
				</thead>
                @foreach ($comprobantes as $comprobante)
					<tr>
						
						<td class="text-center">{{$comprobante->id}}</td>
						<td class="text-center">{{$comprobante->tipo_comprobante}}</td>
						<td class="text-center"><button class="btn @if ($comprobante->estado==1 or $comprobante->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($comprobante->estado==1 or $comprobante->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$comprobantes->render()}}
	</div>
</div>
</x-app-layout>