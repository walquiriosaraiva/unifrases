@section('titulo','Página principal Unifrases')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('titulo') </title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/home2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.modif.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"/>

    <script scr="{{asset('js/Auxiliar.js')}}"></script>
<!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-156704144-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-156704144-1');
    </script>

</head>

<body>
<div class="container-fluid well-lg">

    @unless (Auth::guest())
        <header class="row container-fluid">
            <nav class="navbar navbar-inversed nav-justified well-sm ">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{route('admin')}}">
                            <img src="/img/logo-unifrases.gif" class="img-responsive-mod" alt="logo-unifrases">
                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href={{route('admin')}}> Home </a></li>
                        <li><a href={{route('idiomas.show')}}> Idiomas </a></li>
                        <li><a href={{route('frases.show')}}> Frases </a></li>
                        <li><a href='/' target="_blank"> Site </a></li>
                        @if(in_array(Auth::user()->perfil, array(1, 2)))
                            <li><a href="{{route('user.show')}}">Usuários</a></li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('admin.edit')}}"><span
                                        class="glyphicon glyphicon-user"></span> {{Auth::user()->name}} </a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-in"></span> Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    @endunless

    <div class="row">
        @yield('conteudo')
    </div>

    <footer class="container-fluid welld">
        <div class="container">
            <div class="row col-md-5 pull-left"> &reg; Copyright UniFrases 2013-{{date('Y')}} - Todos os direitos
                reservados.
            </div>
        </div>
    </footer>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/translate.min.js')}}"></script>
    <script src="{{asset('js/default.js')}}"></script>
</div>
</body>
</html>