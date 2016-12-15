@extends('layout/principal')

@section('conteudo')
<div class="container">
	<h1>Portal de Eventos</h1>
	
	<div class="row">
		<ul class="nav navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="{{ url('/aluno/cadastro') }}">Cadastrar Aluno</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/palestra/participacao') }}">Certificado</a>
			</li>

			@if (auth()->guard('colaborador')->user())
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/evento/lista') }}">Lista de Eventos</a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/colaborador/login') }}">Área administrativa</a>
				</li>
			@endif
		</ul>
	</div>

	@if (count($eventos) > 0)
	<div class="row">
		@foreach ($eventos as $e)
			<div class="col-md-4">
				<a href="{{ url('/eventos/' . $e->slug) }}" title="{{$e->nome}}">
		   			<img src="{{ url($e->foto_capa) }}" width="260">
		   			<p>{{$e->nome}}</p>
		   		</a>
	   			<p>Inscrições: {{$e->data_insc_inicio}} até {{$e->data_insc_fim}} </p>
	   			<p>Realização: {{$e->data_rea_inicio}} até {{$e->data_rea_fim}} </p>				
			</div>
		@endforeach
	</div>
	@else
	<div class="container">
		<p>Nenhum evento disponível no momento. Volte novamente mais tarde.</p>
	</div>
	@endif
</div>
@stop