<form action="{{ url('productos') }}" method="GET" autocomplete="off" role="search">
	<div class="form-group">
		<div class="input-group">
			<input type="search" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">{{__('Buscar')}}</button>
			</span>
		</div>
	</div>
</form>