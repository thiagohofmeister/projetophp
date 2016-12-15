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
    <form id="formExemplo" data-toggle="validator" action="/palestra/add" enctype="multipart/form-data" role="form" method="post">
  <div class="form-group">
    <label for="textTitulo" class="control-label">Titulo</label>
    <input id="textTitulo" class="form-control" name="titulo" placeholder="Digite o Titulo" type="text" value="{{old('titulo')}}">
  </div>

  <div class="form-group">
    <label for="textData" class="control-label">Data</label>
    <input id="textData" class="form-control mask-data" name="data" placeholder="Digite a data" type="date" value="{{old('data')}}">
  </div>

  <div class="form-group">
    <label for="textHora" class="control-label">hora</label>
    <input id="textHora" class="form-control mask-time" name="hora" placeholder="Digite a hora" type="time" value="{{old('hora')}}">
  </div>
  
  <div class="form-group">
    <label for="textDuracao" class="control-label">Duração</label>
    <input id="textDuracao" class="form-control mask-time" name="duracao" placeholder="Digite a Duração" type="time" value="{{old('duracao')}}">
  </div>

   <div class="form-group">
    <label for="textFoto" class="control-label">Foto</label>
    <input id="textFoto" class="form-control" name="foto_capa" type="file" value="{{old('foto_capa')}}">
  </div>
  
  <div class="form-group">
    <label for="textDescricao" class="control-label">Descrição</label>
    <textarea class="form-control" name="descricao" rows="5" id="comment" placeholder="Digite a Descrição">{{old('descricao')}}</textarea>
  </div>

  <div class="form-group">
    <label for="textConteudo" class="control-label">Conteúdos</label>
    <textarea class="form-control" name="conteudos" rows="5" placeholder="Digite o Conteudo" id="comment">{{old('conteudos')}}</textarea>
  </div>

  <div class="form-group">
   <select class="selectpicker" name="id_palestrante" title="Selecione o Palestrante">
      @foreach ($palestrantes as $palestrante)
        <option value="{{ $palestrante->id }}" {{ (old('id_palestrante') == $palestrante->id) ? 'select' : '' }}>{{ $palestrante->nome }}</option>
      @endforeach
   </select>
  </div>
  <div class="form-group">
    <select class="selectpicker" name="id_sala" title="Selecione a Sala">
        @foreach ($salas as $sala)
          <option value="{{ $sala->id }}" {{ (old('id_sala') == $sala->id) ? 'select' : '' }}>{{ $sala->nome }} {{ !empty($sala->adaptavel) ? ' - adaptável' : '' }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
   <select class="selectpicker" multiple name="recurso[]" multiple title="Selecione os Recursos">
        @foreach ($recursos as $recurso)
            <option value="{{ $recurso->id }}" {{ (old('equipe') == $recurso->id) ? 'select' : '' }}>{{ $recurso->nome }}</option>
        @endforeach
   </select>
  </div>
  <div class="form-group">
   <select class="selectpicker" multiple name="equipe[]" multiple title="Selecione a Equipe">
      @foreach ($colaboradores as $colaborador)
        <option value="{{ $colaborador->id }}" {{ (old('equipe') == $colaborador->id) ? 'select' : '' }}>{{ $colaborador->nome }}</option>
      @endforeach
   </select>
  </div>
  <div class="form-group">
   <select class="selectpicker" name="id_evento" title="Selecione o Evento">
      @foreach ($eventos as $evento)
        <option value="{{ $evento->id }}" {{ (old('id_evento') == $evento->id) ? 'select' : '' }}>{{ $evento->nome }}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop