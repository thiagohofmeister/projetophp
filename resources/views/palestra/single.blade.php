@extends('layout/principal')

@section('conteudo')
<div class="container">
	<img src="{{ url($palestra->foto_capa) }}" width="400">
	<h1>{{$palestra->titulo}}</h1>
	<p>{{$palestra->descricao}}</p>

	@if (strtotime($palestra->data_insc_inicio) <= strtotime(date('Y-m-d')) && strtotime($palestra->data_insc_fim) >= strtotime(date('Y-m-d')))
		<a href="{{ url('palestra/participar/'.$palestra->slug) }}" class="btn btn-success">Quero Participar!</a>
	@endif
</div>
@stop