@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Administração de Alunos</h1>

	<a href="{{ url('aluno/cadastro') }}" class="btn btn-success">Cadastrar Aluno</a>
	
	@if (count($alunos) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alunos as $a)
			<tr>
				<td>{{ $a->nome }}</td>
				<td>{{ $a->email }}</td>
				<td>
					<a href="{{ url('aluno/edit/'.$a->id) }}" class="btn btn-xs btn-info">Editar</a>
					<a href="javascript:void(0)" data-ref="{{ url('aluno/del/'.$a->id) }}" class="btn btn-xs btn-danger confirm-delete">Excluir</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@stop