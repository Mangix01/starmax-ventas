<x-app-layout>
<h3>{{ __('Editar') }} Venta Nro: {{ $venta->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('ventas.update', $venta->id) }}" method="POST"  enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" name="id" value="{{$venta->id}}" readonly>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Venta</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="numero_comprobante">NUMERO COMPROBANTE *</label>
            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" value="{{old('numero_comprobante',$venta->numero_comprobante)}}" placeholder="{{__('Digite aquí') }} Numero Comprobante *..." required>
            @error('numero_comprobante') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Estado(*)</label>
                <select name="estado" class="form-control"  required>
                    <option @if ($venta->estado == "1") selected @endif value="1">Activo</option><option @if ($venta->estado == "0") selected @endif value="0">Inactivo</option>
                </select>
            </div>
        </div>
      <div class="col-lg-4">
		<div class="form-group">
			<label>CLIENTE *</label>
			<select name="idCliente" id="idCliente" class="form-control" required>
				<option value="">{{ __('Seleccionar') }} CLIENTE</option>
					@foreach ($clientes as $cliente)
				<option {{ old('idCliente',$venta->idCliente) == $cliente->id ? 'selected' : '' }} 
								value="{{$cliente->id}}">{{ $cliente->persona->razon_social }}
					</option>
				@endforeach
			</select>
		</div>
	</div>
                                 <div class="col-lg-4">
		<div class="form-group">
			<label>COMPROBANTE *</label>
			<select name="idComprobante" id="idComprobante" class="form-control" required>
				<option value="">{{ __('Seleccionar') }} COMPROBANTE</option>
				@if($venta->comprobante->estado==false)
                		<option selected value={{$venta->idComprobante}}>{{$venta->comprobante->tipo_comprobante}}</option>
           	 				@endif
										@foreach ($comprobantes as $comprobante)
				<option {{ old('idComprobante',$venta->idComprobante) == $comprobante->id ? 'selected' : '' }} 
								value="{{$comprobante->id}}">{{ $comprobante->tipo_comprobante }}
					</option>
				@endforeach
			</select>
		</div>
	</div>
                                 
      </div>
      <div class="card card-primary">
        <div class="card-header">
            Detalle de Venta
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4">
          		<div class="form-group">
          			<label>PRODUCTO *</label>
          			<select name="idProducto" id="idProducto" class="form-control" >
          				<option value="">{{ __('Seleccionar') }} PRODUCTO</option>
          					@foreach ($productos as $producto)
          				<option {{ old('idProducto',$venta->idProducto) == $producto->id ? 'selected' : '' }} 
          								value="{{$producto->id}}">{{ $producto->nombre }}
          					</option>
          				@endforeach
          			</select>
          		</div>
          	</div>
                                 
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="cantidad">CANTIDAD *</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="cantidad..." onchange="calcularSubtotal();">
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="precio">PRECIO *</label>
                    <input type="decimal" name="precio" id="precio" class="form-control" placeholder="precio..." onchange="calcularSubtotal();">
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="descuento">DESCUENTO</label>
                    <input type="decimal" name="descuento" id="descuento" class="form-control" placeholder="descuento..." onchange="calcularSubtotal();">
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="subtotal">SUBTOTAL *</label>
                    <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="subtotal..." onchange="calcularSubtotal();">
                </div>
            </div>
            
            <div class="col-lg-4">
                  <div class="form-group">
                        <label></label>
                        <a href="#" onclick="agregar();" class="btn btn-success" title="Presione boton para agregar items a Ventas">{{__('Agregar')}}</a>
                  </div>
            </div>
          </div>
          <div class="row"> 
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-dark">
                        <th class="text-left">PRODUCTO</th>
                        <th class="text-right">CANTIDAD</th>
                        <th class="text-right">PRECIO</th>
                        <th class="text-right">DESCUENTO</th>
                        <th class="text-right">SUBTOTAL</th>
                        
                        <th class="text-center">Opciones</th>
                    </thead>
                    @foreach ($detalle_ventas as $key => $detalle_venta)
                    <tr class="selected" id="fila{{ $key }}">
                        <td class="text-left"><input id="idProducto{{ $key }}" type="hidden" name="aidProducto[]" value="{{$detalle_venta->idProducto}}">{{$detalle_venta->producto->nombre}}</td>
                        <td class="text-right"><input id="cantidad{{ $key }}" type="hidden" name="acantidad[]" value="{{$detalle_venta->cantidad}}">{{$detalle_venta->cantidad}}</td>
                        <td class="text-right"><input id="precio{{ $key }}" type="hidden" name="aprecio[]" value="{{$detalle_venta->precio}}">{{$detalle_venta->precio}}</td>
                        <td class="text-right"><input id="descuento{{ $key }}" type="hidden" name="adescuento[]" value="{{$detalle_venta->descuento}}">{{$detalle_venta->descuento}}</td>
                        <td class="text-right"><input id="subtotal{{ $key }}" type="hidden" name="asubtotal[]" value="{{$detalle_venta->subtotal}}">{{$detalle_venta->subtotal}}</td>
                        
                        <td class="text-center"><button type="button" class="btn btn-danger" onclick="eliminar('{{ $key }}');">X</button></td>
                    </tr>
                    @endforeach
                    <tfoot>
                    <td colspan="4" class="text-right"><strong>Total :</strong></td>
                    <td  class="text-center"><h5><input class="text-center font-weight-bold" type="text" name="total" id="total" value="{{ number_format($venta->total,2) }}" readonly></h5></td>
                  </tfoot>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
        <center>
          <div class="form-group text-right">
            <a href="{{URL::action('App\Http\Controllers\VentasControlador@index')}}" class="btn btn-danger">{{__('Volver')}}</a>
            <button id="guardar" class="btn btn-primary" type="submit" title="Actualizar datos ingresados">{{__('Guardar')}}</button>
          </div>
        </center>      
      </div>
    </div>
  </div>
</form>
<script>
  const detalle_ventas = @json($detalle_ventas);
  cont=detalle_ventas.length;
  index = cont;
  total=@json($venta['total']);

  // Agrega item al detalle de Ventas
  function agregar(){
        // idProducto=document.getElementById('idProducto').value;         
        Producto=$("#idProducto option:selected").text(); 
        
        idProducto=$("#idProducto").val();
        cantidad=$("#cantidad").val();
        precio=$("#precio").val();
        descuento=$("#descuento").val();
        subtotal=$("#subtotal").val();
        
        if(idProducto!=""){
              total=Number(total)+Number(subtotal);
              var fila='</tr><tr class="selected" id="fila'+index+'"><td><input id="idProducto'+index+'" type="hidden" name="aidProducto[]" value="'+idProducto+'">'+Producto+'</td><td><input id="cantidad'+index+'" type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input id="precio'+index+'" type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td><input id="descuento'+index+'" type="hidden" name="adescuento[]" value="'+descuento+'">'+descuento+'</td><td><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td class="text-center"><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
              cont++; index++;
              limpiar();
              $("#total").val(total);
              $('#detalles').append(fila);
              evaluar();
        }else{
              alert("Error al ingresar el detalle de Ventas, revise los datos");
        }
  }
  function limpiar(){
    $("#idProducto").val("")
    $("#cantidad").val("")
    $("#precio").val("")
    $("#descuento").val("")
    $("#subtotal").val("")
    
  }

  // Al presiona X elimina la fila
  function eliminar(index){
    cont--;
    total=total-$("#subtotal" + index).val();
    $("#total").val(total);
    $("#fila" + index).remove();
    evaluar();
  }

  function evaluar(){
    if(cont>0){
      $("#guardar").show();
    } else {
      $("#guardar").hide();
    }
  }
  // Calculo de subtotal
  function calcularSubtotal(){
    cantidad=$("#cantidad").val();
    precio=$("#precio").val();
    descuento = $("#descuento").val();
    subtotal = (Number(cantidad)*Number(precio)-Number(descuento)).toFixed(2);
    $("#subtotal").val(subtotal);
  }
  // Tomar el Precio
  document.getElementById("idProducto" ).addEventListener( "change" , colocarPrecio);  

  function colocarPrecio(){
     const productos= @json($productos);
     idProducto=document.getElementById('idProducto').value;
     const result = productos.filter(productos=> productos.id === Number(idProducto)); 
     if(idProducto>0)
         $("#precio").val(result[0].precio);
  }
</script>
</x-app-layout>