<div class="row">
	
	<div class="col-lg-3">
		<div class="input-group">
			<label class="form-control">Fecha Inicial : </label>
			<input type="Date" class="form-control" name="FechaIni" id="fecha_inicial" placeholder="Buscar..." value="{{$FechaIni}}">
		</div>
	</div>
	<div class="col-lg-3">
		<div class="input-group">
			<label class="form-control">Fecha Final : </label>
			<input type="Date" class="form-control" name="FechaFin" id="fecha_final" placeholder="Buscar..." value="{{$FechaFin}}">
		</div>
	</div>
	<div class="col-lg-1">
		<div class="form-group">
			<button type="submit" id="filtrar" class="btn btn-primary">Filtrar</button>
		</div>
	</div>
  <div class="col-5">
    <div class="row">
      <div class="col-md-12 text-right">
        <div class="filtro-ventas d-inline-flex">
        	<button class="btn btn-info btn-sm mr-1" onclick="establecerFechas('ultimos7dias');">Últimos 7 días</button>
          <button class="btn btn-info btn-sm mr-1" onclick="establecerFechas('hoy');">Hoy</button>
          <button class="btn btn-info btn-sm mr-1" onclick="establecerFechas('estaSemana');" title="Inicia el lunes">Esta semana</button>
          <button class="btn btn-info btn-sm mr-1" onclick="establecerFechas('esteMes');">Este mes</button>
          <button class="btn btn-info btn-sm mr-1" onclick="establecerFechas('esteAnno');">Este año</button>
        </div>
      </div>
    </div>
  </div>
</div>