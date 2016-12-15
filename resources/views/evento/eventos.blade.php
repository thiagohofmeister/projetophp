@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Eventos</h1>

	<a href="{{ url('evento/cadastro') }}" class="btn btn-success">Cadastrar Evento</a>
	
	@if (count($eventos) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Título do Evento</th>
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($eventos as $e)
			<tr>
				<td>{{ $e->nome }}</td>
				<td>{{ strlen($e->descricao) > 123 ? substr($e->descricao, 0, 120) . '...' : $e->descricao }}</td>
				<td>
					<a href="{{ url('evento/edit/'.$e->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('evento/del/'.$e->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop