@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Recursos</h1>

	<a href="{{ url('recurso/cadastro') }}" class="btn btn-success">Cadastrar Recurso</a>
	
	@if (count($recursos) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Quantidade</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($recursos as $r)
			<tr>
				<td>{{ $r->nome }}</td>
				<td>{{ $r->quantidade }}</td>
				<td>
					<a href="{{ url('recurso/edit/'.$r->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('recurso/del/'.$r->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop