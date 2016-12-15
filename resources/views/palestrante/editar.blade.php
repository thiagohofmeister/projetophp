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
    <form id="formExemplo" data-toggle="validator" enctype="multipart/form-data" action="/palestrante/edit/{{ $palestrante->id }}" role="form" method="post">
  <div class="form-group">
    <label for="textCurriculo" class="control-label">Palestrante</label>
    <input id="textCurriculo" class="form-control" name="nome" placeholder="Digite o Nome do Palestrante" type="text" value="{{ $palestrante->nome }}">
  </div>

  <div class="form-group">
    <label for="textCurriculo" class="control-label">Curriculo</label>
    <textarea class="form-control" name="curriculo" rows="5" placeholder="Digite o Conteudo" id="comment">{{ $palestrante->curriculo }}</textarea>
  </div>

   <div class="form-group">
    <label for="textFoto" class="control-label">Foto</label>
    <input id="textFoto" class="form-control" name="foto" type="file" value="{{ $palestrante->foto }}">
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop