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
  <h1>Cadastro de Colaborador</h1>
    <form id="formExemplo" data-toggle="validator" action="/colaborador/edit/{{ $colaborador->id }}" role="form" method="post">
  <div class="form-group">
    <label for="textColaborador" class="control-label">Colaborador</label>
    <input id="textColaborador" class="form-control" name="nome" placeholder="Digite o Nome do colaborador" type="text" value="{{ $colaborador->nome }}">
  </div>

  <div class="form-group">
    <label for="textEmail" class="control-label">E-mail</label>
    <input id="textEmail" class="form-control" name="email" placeholder="Digite o E-mail" type="email" value="{{ $colaborador->email }}">
  </div>

  <div class="form-group">
    <label for="textTelefone" class="control-label">Telefone</label>
    <input id="textTelefone" class="form-control" name="telefone" placeholder="Digite o numero" type="phone" value="{{ $colaborador->telefone }}">
  </div>
  
  <div class="form-group">
    <label for="textDataNas" class="control-label">Data de Nascimento</label>
    <input id="textDataNas" class="form-control" name="data_nascimento" placeholder="Digite a data de nascimento" type="date" value="{{ $colaborador->data_nascimento }}">
  </div>
  
  <div class="form-group">
    <label for="textSenha" class="control-label">Senha</label>
    <input id="textSenha" class="form-control" name="password" placeholder="Digite a senha" type="password" value="{{ $colaborador->senha }}">
  </div>
  
  <div class="form-group">
    <label for="textSenha" class="control-label">Confirmar Senha</label>
    <input id="textSenha" class="form-control" name="password_confirmation" placeholder="Digite a senha" type="password" value="{{ $colaborador->senha }}">
  </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
</div>
@stop