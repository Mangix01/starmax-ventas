<x-app-layout>

<h3> Compra Nro: {{ $compra->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif

<div class="card card-primary">
  	<div class="card-header">
    	<h3 class="card-title">Compra</h3>
  	</div>
  	<div class="card-body">
	    <div class="row">
	    	<div class="col-lg-4">
				<div class="form-group">
					<label for="fecha_recepcion">FECHA RECEPCION</label>
					<input type="datetime-local" name="fecha_recepcion" class="form-control" value="{{$compra->fecha_recepcion}}"  disabled>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="numero_comprobante">NUMERO COMPROBANTE *</label>
					<input type="text" name="numero_comprobante" class="form-control" value="{{$compra->numero_comprobante}}"  disabled>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="estado">ESTADO *</label>
					<input type="text" name="estado"  value="{{$compra->estado==1 ? 'Activo' : 'Inactivo'}}"  class="form-control" disabled>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="idComprobante">COMPROBANTE *</label>
					<input type="text" name="idComprobante" class="form-control" value="{{$compra->comprobante->tipo_comprobante}}"  disabled>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label for="idProveedore">PROVEEDORE *</label>
					<input type="text" name="idProveedore" class="form-control" value="{{$compra->proveedore->persona->razon_social}}"  disabled>
				</div>
			</div>
			
		</div>
		<div class="card card-primary">
	      	<div class="card-header">
	          	{{ __('Detalle de') }} Compra
	      	</div>
	      	<div class="card-body">
		        <div class="row"> 
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead class="thead-dark">
									
									<th class="text-left">PRODUCTO</th>
									<th class="text-right">CANTIDAD</th>
									<th class="text-right">PRECIO</th>
									<th class="text-right">SUBTOTAL</th>
								</thead>
				               @foreach ($detalle_compras as $detalle_compra)
								<tr>
									
									<td class="text-left">{{$detalle_compra->producto->nombre}}</td>
									<td class="text-right">{{$detalle_compra->cantidad}}</td>
									<td class="text-right">{{$detalle_compra->precio}}</td>
									<td class="text-right">{{$detalle_compra->subtotal}}</td>
								</tr>
								@endforeach
								<tfoot>
									<td colspan="3" class="text-right"><strong>Total :</strong></td>
									<td  class="text-center font-weight-bold"><h5>{{ number_format($compra->total,2) }}</h5></td>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="form-group text-right">
	           	<a href="{{URL::action('App\Http\Controllers\ComprasControlador@index')}}" class="btn btn-danger" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
	        </div>
		</div>
	</div>
</div>
</x-app-layout>