@extends('components.modal')

@section('modal-estilos')
    @vite(['resources/css/ventas.css'])
@endsection

@section('modal-title', 'Buscador')

@section('modal-content')
<div class="search-container">
	<div class="search-box">
		<i class="fas fa-search">
		</i>
		<input placeholder="BUSCAR" type="text" />
	</div>
</div>
<table class="simple-table">
	<thead>
		<tr>
			<th>
				NOMBRE DEL PRODUCTO
			</th>
			<th>
				CÓDIGO DEL PRODUCTO
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				PLAYERA DE NATANAEL CANO
			</td>
			<td>
				SA049144
			</td>
		</tr>
	</tbody>
</table>
@endsection