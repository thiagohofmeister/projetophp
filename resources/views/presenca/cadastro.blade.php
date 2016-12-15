@extends('layout/principal')

@section('conteudo')
<div class="container">
  <h1>Confirmar presença na palestra</h1>
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
    <form id="formExemplo" data-toggle="validator" action="/presenca/marcar" role="form" method="post">
  <div class="form-group">
    <label for="textCodPalestra" class="control-label">Código da Palestra</label>
    <input id="textCodPalestra" class="form-control" name="codigo_palestra" placeholder="Digite o Código da Palestra" type="text" value="{{old('codigo_palestra')}}">
  </div>

  <div class="form-group">
    <label for="textRaAluno" class="control-label">RA do Aluno</label>
    <input id="textRaAluno" class="form-control" name="ra"  type="text" value="{{old('ra')}}" placeholder="Digite o RA">
  </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Confirmar</button>
</form>
</div>
@stop