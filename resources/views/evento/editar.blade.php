@extends('layout/principal')

@section('conteudo')
<div class="container">
  <h1>Cadastro de Evento</h1>
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
    <form id="formExemplo" data-toggle="validator" enctype="multipart/form-data" action="/evento/edit/{{ $evento->id }}" role="form" method="post">
  <div class="form-group">
    <label for="textSala" class="control-label">Evento</label>
    <input id="textSala" class="form-control" name="nome" placeholder="Digite o Nome do Evento" type="text" value="{{ $evento->nome }}">
  </div>

  <div class="form-group">
    <label for="textDescricao" class="control-label">Descrição</label>
    <textarea id="textDescricao" class="form-control" name="descricao" placeholder="Digite a descricão" type="text">{{ $evento->descricao }}</textarea>
  </div>

   <div class="form-group">
    <label for="textFoto" class="control-label">Foto</label>
    <input id="textFoto" class="form-control" name="foto_capa" type="file" value="{{ $evento->foto_capa}}">
  </div>

  <div class="form-group">
    <label for="textDescricao" class="control-label">Período de Inscrição</label>
    <input id="textDescricao" class="form-control mask-date-time" name="data_insc_inicio" type="datetime" value="{{ $evento->data_insc_inicio}}" placeholder="Data inicial">
    <input id="textDescricao" class="form-control mask-date-time" name="data_insc_fim" type="datetime" value="{{ $evento->data_insc_fim}}" placeholder="Data final">
  </div>

   <div class="form-group">
    <label for="textDescricao" class="control-label">Período de Realização</label>
    <input id="textDescricao" class="form-control mask-date-time" name="data_rea_inicio" type="datetime" value="{{ $evento->data_rea_inicio}}" placeholder="Data inicial">
    <input id="textDescricao" class="form-control mask-date-time" name="data_rea_fim" type="datetime" value="{{ $evento->data_rea_fim}}" placeholder="Data final">
  </div>

   <div class="form-group">
    <label for="textDescricao" class="control-label">Período de Exibição no Portal</label>
    <input id="textDescricao" class="form-control mask-date-time" name="data_exi_inicio" type="datetime" value="{{ $evento->data_exi_inicio}}" placeholder="Data inicial">
    <input id="textDescricao" class="form-control mask-date-time" name="data_exi_fim" type="datetime" value="{{ $evento->data_exi_fim}}" placeholder="Data final">
  </div>

  <div class="form-group">
    <label for="textStatus" class="control-label">Status</label>


    <div class="radio">
      <label>
        <input type="radio" name="status" value="1" {{ ( $evento->status == 1) ? 'checked' : '' }}>
        <span class="label label-success">Ativo</span>
      </label>

      <label>
        <input type="radio" name="status" value="0" {{ ( $evento->status == 0) ? 'checked' : '' }}>
        <span class="label label-danger">Inativo</span>
      </label>
    </div>
  </div>
  
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop