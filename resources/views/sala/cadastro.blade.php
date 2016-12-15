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
  <form id="formExemplo" data-toggle="validator" action="/sala/add" role="form" method="post">
  <div class="form-group">
    <label for="textSala" class="control-label">Sala</label>
    <input id="textSala" class="form-control" name="nome" placeholder="Digite o Nome da Sala" type="text" value="{{old('nome')}}">
  </div>
  
  <div class="form-group">
    <label for="textCapacidade" class="control-label">Capacidade</label>
    <input id="textCapacidade" class="form-control" name="capacidade" placeholder="Digite a Capacidade" type="text" value="{{old('capacidade')}}">
  </div>

  <div class="form-group">
    <label for="textAdaptavel" class="control-label">Adaptável</label>


    <div class="radio">
      <label>
        <input type="radio" name="adaptavel" value="1" {{ (old('adaptavel') == 1) ? 'checked' : '' }}>
        <span class="label label-success">Ativo</span>
      </label>

      <label>
        <input type="radio" name="adaptavel" value="0" {{ (old('adaptavel') == 0) ? 'checked' : '' }}>
        <span class="label label-danger">Inativo</span>
      </label>
    </div>
  </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop