@extends('layout.principal')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bem-vindo(a) {{auth()->guard('aluno')->user()->nome}}</div>

                <div class="panel-body">
                    <div class="row">
                        @if (count($palestras_novas) > 0)
                        <div class="col-md-6">
                            <h4>Palestras que irá participar</h4>
                            <ul>
                                @foreach ($palestras_novas as $p)
                                    <li><a href="{{ url('palestras/'.$p->slug) }}" title="{{ $p->titulo }}">{{ $p->titulo }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (count($palestras) > 0)
                        <div class="col-md-6">
                            <h4>Palestras que compareceu</h4>
                            <ul>
                                @foreach ($palestras as $p)
                                    <li><a href="{{ url('palestras/'.$p->slug) }}" title="{{ $p->titulo }}">{{ $p->titulo }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
