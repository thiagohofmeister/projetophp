@extends('layout/principal')

@section('conteudo')
<div class="container">        
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
  @endif

  @if (session('msg'))
  <div class="alert alert-success">
    <ul>      
       <li>{{ session('msg') }}</li>
    </ul>
  </div>
  @endif
<div class="container">
    <form id="formExemplo" data-toggle="validator" action="/palestra/edit/{{ $palestra->id }}" enctype="multipart/form-data" role="form" method="post">
  <div class="form-group">
    <label for="textTitulo" class="control-label">Titulo</label>
    <input id="textTitulo" class="form-control" name="titulo" placeholder="Digite o Titulo" type="text" value="{{ $palestra->titulo }}">
  </div>

  <div class="form-group">
    <label for="textData" class="control-label">Data</label>
    <input id="textData" class="form-control mask-data" name="data" placeholder="Digite a data" type="date" value="{{ $palestra->data }}">
  </div>

  <div class="form-group">
    <label for="textHora" class="control-label">hora</label>
    <input id="textHora" class="form-control mask-time" name="hora" placeholder="Digite a hora" type="time" value="{{ $palestra->hora }}">
  </div>
  
  <div class="form-group">
    <label for="textDuracao" class="control-label">Duração</label>
    <input id="textDuracao" class="form-control mask-time" name="duracao" placeholder="Digite a Duração" type="time" value="{{ $palestra->duracao }}">
  </div>

   <div class="form-group">
    <label for="textFoto" class="control-label">Foto</label>
    <input id="textFoto" class="form-control" name="foto_capa" type="file" value="{{ $palestra->foto_capa }}">
  </div>
  
  <div class="form-group">
    <label for="textDescricao" class="control-label">Descrição</label>
    <textarea class="form-control" name="descricao" rows="5" id="comment" placeholder="Digite a Descrição">{{ $palestra->descricao }}</textarea>
  </div>

  <div class="form-group">
    <label for="textConteudo" class="control-label">Conteúdos</label>
    <textarea class="form-control" name="conteudos" rows="5" placeholder="Digite o Conteudo" id="comment">{{ $palestra->conteudos }}</textarea>
  </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop