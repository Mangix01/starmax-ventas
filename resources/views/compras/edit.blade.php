<x-app-layout>
<h3>{{ __('Editar') }} Compra Nro: {{ $compra->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('compras.update', $compra->id) }}" method="POST"  enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <input type="hidden" name="id" value="{{$compra->id}}" readonly>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Compra</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="fecha_recepcion">FECHA RECEPCION</label>
            <input type="datetime-local" name="fecha_recepcion" id="fecha_recepcion" class="form-control" value="{{old('fecha_recepcion',$compra->fecha_recepcion)}}" placeholder="{{__('Digite aquí') }} Fecha Recepcion..." >
            @error('fecha_recepcion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="numero_comprobante">NUMERO COMPROBANTE *</label>
            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" value="{{old('numero_comprobante',$compra->numero_comprobante)}}" placeholder="{{__('Digite aquí') }} Numero Comprobante *..." required>
            @error('numero_comprobante') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label>Estado(*)</label>
                    <select name="estado" class="form-control"  required>
                        <option @if ($compra->estado == "1") selected @endif value="1">Activo</option><option @if ($compra->estado == "0") selected @endif value="0">Inactivo</option>
                    </select>
                </div>
            </div><div class="col-lg-4">
		<div class="form-group">
			<label>COMPROBANTE *</label>
			<select name="idComprobante" id="idComprobante" class="form-control" required>
				<option value="">{{ __('Seleccionar') }} COMPROBANTE</option>
				@if($compra->comprobante->estado==false)
                		<option selected value={{$compra->idComprobante}}>{{$compra->comprobante->tipo_comprobante}}</option>
           	 				@endif
										@foreach ($comprobantes as $comprobante)
				<option {{ old('idComprobante',$compra->idComprobante) == $comprobante->id ? 'selected' : '' }} 
								value="{{$comprobante->id}}">{{ $comprobante->tipo_comprobante }}
					</option>
				@endforeach
			</select>
		</div>
	</div>
                                 <div class="col-lg-4">
		<div class="form-group">
			<label>PROVEEDORE *</label>
			<select name="idProveedore" id="idProveedore" class="form-control" required>
				<option value="">{{ __('Seleccionar') }} PROVEEDORE</option>
					@foreach ($proveedores as $proveedore)
				<option {{ old('idProveedore',$compra->idProveedore) == $proveedore->id ? 'selected' : '' }} 
								value="{{$proveedore->id}}">{{ $proveedore->persona->razon_social }}
					</option>
				@endforeach
			</select>
		</div>
	</div>
                                 
      </div>
      <div class="card card-primary">
        <div class="card-header">
            Detalle de Compra
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4">
		<div class="form-group">
			<label>PRODUCTO *</label>
			<select name="idProducto" id="idProducto" class="form-control" >
				<option value="">{{ __('Seleccionar') }} PRODUCTO</option>
					@foreach ($productos as $producto)
				<option {{ old('idProducto',$compra->idProducto) == $producto->id ? 'selected' : '' }} 
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
                    <label for="subtotal">SUBTOTAL *</label>
                    <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="subtotal..." onchange="calcularSubtotal();">
                </div>
            </div>
            
            <div class="col-lg-4">
                  <div class="form-group">
                        <label></label>
                        <a href="#" onclick="agregar();" class="btn btn-success" title="Presione boton para agregar items a Compras">{{__('Agregar')}}</a>
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
                        <th class="text-right">SUBTOTAL</th>
                        
                        <th class="text-center">Opciones</th>
                    </thead>
                    @foreach ($detalle_compras as $key => $detalle_compra)
                    <tr class="selected" id="fila{{ $key }}">
                        <td class="text-left"><input id="idProducto{{ $key }}" type="hidden" name="aidProducto[]" value="{{$detalle_compra->idProducto}}">{{$detalle_compra->producto->nombre}}</td>
                        <td class="text-right"><input id="cantidad{{ $key }}" type="hidden" name="acantidad[]" value="{{$detalle_compra->cantidad}}">{{$detalle_compra->cantidad}}</td>
                        <td class="text-right"><input id="precio{{ $key }}" type="hidden" name="aprecio[]" value="{{$detalle_compra->precio}}">{{$detalle_compra->precio}}</td>
                        <td class="text-right"><input id="subtotal{{ $key }}" type="hidden" name="asubtotal[]" value="{{$detalle_compra->subtotal}}">{{$detalle_compra->subtotal}}</td>
                        
                        <td class="text-center"><button type="button" class="btn btn-danger" onclick="eliminar('{{ $key }}');">X</button></td>
                    </tr>
                    @endforeach
                    <tfoot>
                    <td colspan="3" class="text-right"><strong>Total :</strong></td>
                    <td  class="text-center"><h5><input class="text-center font-weight-bold" type="text" name="total" id="total" value="{{ number_format($compra->total,2) }}" readonly></h5></td>
                  </tfoot>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
        <center>
          <div class="form-group text-right">
            <a href="{{URL::action('App\Http\Controllers\ComprasControlador@index')}}" class="btn btn-danger">{{__('Volver')}}</a>
            <button id="guardar" class="btn btn-primary" type="submit" title="Actualizar datos ingresados">{{__('Guardar')}}</button>
          </div>
        </center>      
      </div>
    </div>
  </div>
</form>
<script>
  const detalle_compras = @json($detalle_compras);
  cont=detalle_compras.length;
  index = cont;
  total=@json($compra['total']);

  // Agrega item al detalle de Compras
  function agregar(){
        // idProducto=document.getElementById('idProducto').value;         
        Producto=$("#idProducto option:selected").text(); 
        
        idProducto=$("#idProducto").val();
        cantidad=$("#cantidad").val();
        precio=$("#precio").val();
        subtotal=$("#subtotal").val();
        
        if(idProducto!=""){
              total=Number(total)+Number(subtotal);
              var fila='</tr><tr class="selected" id="fila'+index+'"><td><input id="idProducto'+index+'" type="hidden" name="aidProducto[]" value="'+idProducto+'">'+Producto+'</td><td><input id="cantidad'+index+'" type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input id="precio'+index+'" type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td class="text-center"><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
              cont++; index++;
              limpiar();
              $("#total").val(total);
              $('#detalles').append(fila);
              evaluar();
        }else{
              alert("Error al ingresar el detalle de Compras, revise los datos");
        }
  }
  function limpiar(){
    $("#idProducto").val("")
    $("#cantidad").val("")
    $("#precio").val("")
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
    subtotal = (Number(cantidad)*Number(precio)).toFixed(2);
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