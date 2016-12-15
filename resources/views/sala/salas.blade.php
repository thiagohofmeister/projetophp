@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Salas</h1>

	<a href="{{ url('sala/cadastro') }}" class="btn btn-success">Cadastrar Sala</a>

	@if (session('msg'))
	<div class="alert alert-success">
		<ul>      
		   <li>{{ session('msg') }}</li>
		</ul>
	</div>
	@endif

	@if (count($salas) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Capacidade</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($salas as $s)
			<tr>
				<td>{{ $s->nome }}</td>
				<td>{{ $s->capacidade }}</td>
				<td>
					<a href="{{ url('sala/edit/'.$s->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('sala/del/'.$s->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop