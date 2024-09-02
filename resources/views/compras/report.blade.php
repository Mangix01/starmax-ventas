<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ _('Reporte de') }} Compras</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Compras"; </script>
			<form action="{{ url('compras_report') }}" method="GET" autocomplete="off" role="search">
				<div class="row">
					<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<div class="input-group">
							<label>{{ __('Fecha Inicial') }} : </label>
							<input type="Date" class="form-control" name="FechaIni" placeholder="Buscar..." value="{{$FechaIni}}">
						</div>
					</div>
					<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
						<div class="input-group">
							<label>{{ __('Fecha Final') }} : </label>
							<input type="Date" class="form-control" name="FechaFin" placeholder="Buscar..." value="{{$FechaFin}}">
						</div>
					</div>
					<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<br>
							<button type="submit" class="btn btn-primary">{{ __('Filtrar') }}</button>
						</div>
					</div>
				</div>
			</form>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">FECHA RECEPCION</th>
					<th class="text-center">NUMERO COMPROBANTE</th>
					<th class="text-center">ESTADO</th>
					<th class="text-center">TOTAL</th>
					<th class="text-center">COMPROBANTE</th>
					<th class="text-center">PROVEEDOR</th>
				</thead>
        @foreach ($compras as $compra)
				<tr>
					
					<td class="text-center">{{$compra->id}}</td>
					<td class="text-center">{{$compra->fecha_recepcion}}</td>
					<td class="text-center">{{$compra->numero_comprobante}}</td>
					<td class="text-center"><button class="btn @if ($compra->estado==1 or $compra->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($compra->estado==1 or $compra->estado=="active") Activo @else Inactivo @endif</button></td>
					<td class="text-center">{{$compra->total}}</td>
					<td class="text-center">{{$compra->comprobante->tipo_comprobante}}</td>
					<td class="text-center">{{$compra->proveedore->persona->razon_social}}</td>
				</tr>
				@endforeach
				<tfoot>
					<td></td>
					<td></td>
					<td></td>
					<td class="text-right"><strong>Total :</strong></td>
					<td  class="text-center">{{ number_format($compras->sum('total'),2) }}</td>
				</tfoot>
			</table>
		</div>
		{{$compras->render()}}
	</div>
</div>
</x-app-layout>