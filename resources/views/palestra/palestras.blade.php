@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Palestras</h1>

	<a href="{{ url('palestra/cadastro') }}" class="btn btn-success">Cadastrar Palestra</a>
	
	@if (count($palestras) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Título do Evento</th>
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($palestras as $p)
			<tr>
				<td>{{ $p->titulo }}</td>
				<td>{{ $p->nome }}</td>
				<td>
					<a href="{{ url('palestra/edit/'.$p->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('palestra/del/'.$p->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop