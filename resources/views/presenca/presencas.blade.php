@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Presenças</h1>

	<a href="{{ url('aluno/palestra') }}" class="btn btn-info">Cadastrar Aluno na Palestra</a>
	<a href="{{ url('presenca/cadastro') }}" class="btn btn-success">Confirmar Presença</a>
	
	@if (count($presencas) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Título da Palestra</th>
				<th>Título do Evento</th>
				<th>Quantidade de Participantes</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($presencas as $p)
			<tr>
				<td>{{ $p->titulo }}</td>
				<td>{{ $p->evento }}</td>
				<td>{{ $p->quantidade }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop