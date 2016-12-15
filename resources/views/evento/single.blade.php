@extends('layout/principal')

@section('conteudo')
<div class="container">
	<img src="{{ url($evento->foto_capa) }}" width="400">
	<h1>{{$evento->nome}}</h1>
	<p>{{$evento->descricao}}</p>

	@if (count($palestras) > 0)
	<h2>Palestras</h2>
	<div class="row">
		@foreach ($palestras as $p)
			<div class="col-md-4">
				<a href="{{ url('/palestras/'.$p->slug) }}">
					<img src="{{ url($p->foto_capa) }}" width="100%">
					<h3>{{ $p->titulo }}</h3>
				</a>
				<ul>
					<li>Data: {{ $p->data }} Hora: {{ $p->hora }}</li>
					<li>Duração: {{ $p->duracao }}</li>
				</ul>
				<p>{{ $p->descricao }}</p>
				<h5>Palestrante:</h5>
				<div class="row">
					<div class="col-md-3">
						<img src="{{ url($p->foto) }}" width="100%">
					</div>
					<div class="col-md-4">
						<p>{{ $p->nome }}</p>
					</div>
					<div class="col-md-6">
						<p>Currículo: {{ $p->curriculo }}</p>
					</div>
				</div>
				@if (strtotime($evento->data_insc_inicio) <= strtotime(date('Y-m-d')) && strtotime($evento->data_insc_fim) >= strtotime(date('Y-m-d')))
					<a href="{{ url('palestra/participar/'.$p->slug) }}" class="btn btn-success">Quero Participar!</a>
				@endif
			</div>
		@endforeach
	</div>
	@endif
</div>
@stop