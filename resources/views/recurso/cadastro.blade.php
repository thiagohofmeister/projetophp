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
    <form id="formExemplo" data-toggle="validator" action="/recurso/add" role="form" method="post">
  <div class="form-group">
    <label for="textNome" class="control-label">Recurso</label>
    <input id="textNome" class="form-control" name="nome" placeholder="Digite o Nome do Recurso" type="text"  value="{{old('nome')}}">
  </div>

  <div class="form-group">
    <label for="textQuantidadeDisponivel" class="control-label">Quantidade disponivel</label>
    <input id="textQuantidadeDisponivel" class="form-control" name="quantidade"  type="text" value="{{old('quantidade')}}">
  </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop