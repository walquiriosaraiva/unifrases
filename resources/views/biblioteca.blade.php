@section('titulo','Página de Biblioteca')
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
<div class="container-fluid well-lg"
     style="background-image: linear-gradient(to bottom,#D9EAF0 0,#D9EAF0 100%); background-repeat: repeat-x; border-color: #D9EAF0;">

    @include('menu')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 5px 15px !important;"><h4><strong>Biblioteca</strong></h4></div>
                <div class="panel-body">
                    <div class="panel-group">
                        <a href="http://editoracriacao.com.br/wp-content/uploads/2020/04/biografia-antonio-goes.pdf" target="_blank" title="ANTÔNIO JOSÉ GÓES Uma vida missionária de pioneirismo e de dedicação aos Yanomami do Amazonas"><strong>ANTÔNIO JOSÉ GÓES</strong> Uma vida missionária de pioneirismo e de dedicação aos Yanomami do Amazonas.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('rodape')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/default.js')}}"></script>
</div>
</body>
</html>