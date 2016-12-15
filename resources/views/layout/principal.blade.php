<!DOCTYPE html>
<html lang="BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gestão da QI Semana academica</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?= asset('css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= asset('css/font-awesome.min.css'); ?>">
        <!-- Custom CSS -->
        <link href="<?= asset('css/style.css'); ?>" rel="stylesheet">
        <link href="<?= asset('css/login-register.css'); ?>" rel="stylesheet" />
        <link href="<?= asset('css/estilo.css'); ?>" rel="stylesheet">
        <script src="<?= asset('js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
        <script src="<?= asset('js/login-register.js'); ?>" type="text/javascript"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
        
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/alertify.min.css"/>

        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.8.0/css/themes/semantic.min.css"/>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- COLOCAR O HTML TODO AQUI -->
        <div class="container-fluid nomargin nopadding">
            <header>
                <nav class="navbar navbar-inverse ">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">QISystem</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="{{ Request::is('/') || Request::is('index') ? 'active' : '' }}"><a href="/">Início</a></li>
                            @if (auth()->guard('colaborador')->user())
                                <li class="{{ Request::is('eventos') ? 'active' : '' }}"><a href="/eventos">Eventos</a></li>
                                <li class="{{ Request::is('aluno/lista') ? 'active' : '' }}"><a href="/aluno/lista">Alunos</a></li>
                              <li class="{{ Request::is('sala/lista') ? 'active' : '' }}"><a href="/sala/lista">Salas</a></li>                               
                              <li class="{{ Request::is('palestrante/lista') ? 'active' : '' }}"><a href="/palestrante/lista">Palestrantes</a></li>
                              <li class="{{ Request::is('recurso/lista') ? 'active' : '' }}"><a href="/recurso/lista">Recursos</a></li>
                              <li class="{{ Request::is('colaborador/lista') ? 'active' : '' }}"><a href="/colaborador/lista">Colaboradores</a></li>
                              <li class="{{ Request::is('palestra/lista') ? 'active' : '' }}"><a href="/palestra/lista">Palestras</a></li>                              
                              <li class="{{ Request::is('presenca/lista') ? 'active' : '' }}"><a href="/presenca/lista">Presenças</a></li>
                            @else
                              <li class="{{ Request::is('eventos') ? 'active' : '' }}"><a href="/eventos">Eventos</a></li> 
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if (auth()->guard('colaborador')->user())
                                <li class="{{ Request::is('colaborador') ? 'active' : '' }}">
                                    <a href="{{ url('/colaborador') }}"><span class="glyphicon glyphicon-user"></span> {{ auth()->guard('colaborador')->user()->nome }}</a>
                                </li>

                                <li class="{{ Request::is('colaborador/logout') ? 'active' : '' }}">
                                    <a href="{{ url('/colaborador/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
                                </li>
                            @elseif (auth()->guard('aluno')->user())
                                <li class="{{ Request::is('aluno') ? 'active' : '' }}">
                                    <a href="{{ url('/aluno') }}"><span class="glyphicon glyphicon-user"></span> {{ auth()->guard('aluno')->user()->nome }}</a>
                                </li>

                                <li class="{{ Request::is('aluno/logout') ? 'active' : '' }}">
                                    <a href="{{ url('/aluno/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
                                </li>
                            @else
                                <li class="{{ Request::is('aluno/login') ? 'active' : '' }}"><a href="/aluno/login"><span class="glyphicon glyphicon-log-in"></span> Área do Aluno</a></li>
                                <li class="{{ Request::is('colaborador/login') ? 'active' : '' }}"><a href="/colaborador/login"><span class="glyphicon glyphicon-log-in"></span> Área do Colaborador</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>         
            </header>
        </div>
        
        @yield('conteudo')

        <footer>
            <div class="row nomargin">
                <div class="col-lg-12">
                    <p>Copyright © Your Website 2016</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
        <!--******* SCRIPTS **********-->
        <!-- jQuery -->
        <script src="<?= asset('js/jquery.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= asset('js/bootstrap.min.js'); ?>"></script>
        <script src="<?= asset('js/geral.js'); ?>"></script>
        <script type="text/javascript" src="<?= asset('js/floatlabels.js'); ?>"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

        <!-- (Optional) Latest compiled and minified JavaScript translation files -->

        <!-- Jquery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

        <script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>
    </body>
</html>