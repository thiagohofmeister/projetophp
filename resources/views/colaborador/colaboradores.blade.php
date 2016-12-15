@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Colaboradores</h1>

	<a href="{{ url('colaborador/cadastro') }}" class="btn btn-success">Cadastrar Colaborador</a>
	
	@if (count($colaboradores) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($colaboradores as $c)
			<tr>
				<td>{{ $c->nome }}</td>
				<td>{{ $c->email }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop