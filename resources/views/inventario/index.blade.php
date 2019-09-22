@extends ('layouts.admin')
@section ('contenido')

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>
			Buscar Artículos 
		</h3>
		@include('inventario.search')
	</div>	
</div>

<div class="row" >
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  id="testTable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Ref.</th>
					<th>Contenido</th>
					<th>Bodega</th>
					<!--<th>Categoría</th>-->
					<th>Stock</th>
				</thead>

				@foreach ($articulos as $art)
				<tr>
					<td>{{$art->idarticulo}}</td>
					<td>{{$art->nombre}}</td>
					<td>{{$art->codigo}}</td>
					<td>{{$art->contenido}}</td>
					<td>{{$art->bodega }}</td>
					<!--<td>{{$art->categoria }}</td>-->
					<td>{{$art->stock}}</td>
				</tr>
				@endforeach

			</table>
		</div>
		<!--Mostramos la paginacion-->
		{{$articulos->render()}}
	</div>		

</div>

@endsection
