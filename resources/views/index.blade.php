@extends('layout/principal')

@section('conteudo')
<div class="container">
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