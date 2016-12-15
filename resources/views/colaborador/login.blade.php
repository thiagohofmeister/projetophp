@extends('layout/principal')

@section('conteudo')
<div class="container">
  <h1>Área do Colaborador</h1>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
  @endif
  <form class="form-horizontal" role="form" method="post" action="{{ url('/colaborador/login') }}">
  <div class="form-group">
    <label for="textLogin" class="control-label">Login</label>
    <input id="textLogin" class="form-control" name="email" placeholder="Digite o seu login" type="text" value="{{old('nome')}}">
  </div>
  
  <div class="form-group">
    <label for="textSenha" class="control-label">Senha</label>
    <input id="textSenha" class="form-control" name="password" placeholder="Digite a senha" type="password" value="{{old('senha')}}">
  </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop