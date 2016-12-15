@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Palestrantes</h1>

	<a href="{{ url('palestrante/cadastro') }}" class="btn btn-success">Cadastrar Palestrante</a>
	
	@if (count($palestrantes) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($palestrantes as $p)
			<tr>
				<td>{{ $p->nome }}</td>
				<td>{{ $p->email }}</td>
				<td>
					<a href="{{ url('palestrante/edit/'.$p->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('palestrante/del/'.$p->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop