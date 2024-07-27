@section('titulo','Página de Links')
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
                <div class="panel-heading" style="padding: 5px 15px !important;"><h4><strong>Links</strong></h4></div>
                <div class="panel-body">
                    <div class="panel-group">
                        <a href="http://intervox.nce.ufrj.br/dosvox/download.htm" target="_blank" title="Página do DOSVOX"><strong>O DOSVOX</strong> é um sistema computacional, baseado no uso intensivo de síntese de voz, desenvolvido pelo Instituto Tércio Paciti, que se destina a facilitar o acesso de deficientes visuais a microcomputadores.</a>
                    </div>
                    <div class="panel-group">
                        <a href="http://www.nvda.pt/pt-pt" target="_blank" title="Página do NVDA"><strong>NVDA (NonVisual desktop Access)</strong> é o leitor de tela apenas para o Microsoft Windows que é totalmente gratuito, mas totalmente funcional e portátil.</a>
                    </div>
                    <div class="panel-group">
                        <a href="http://cegosbrasil.net/downloads/nvda-versao-20201-eloquence" target="_blank" title="Página do Portal Cegos Brasil com NVDA"><strong>Portal Cegos Brasil</strong> Download do NVDA.</a>
                    </div>
                    <div class="panel-group">
                        <a href="https://enxergandoofuturo.com.br/" target="_blank" title="Enxergando o Futuro"><strong>Enxergando o Futuro </strong>- Parceiro de referência com reconhecimento público. </a>
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