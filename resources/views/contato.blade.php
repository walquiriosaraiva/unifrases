@section('titulo','Contato Unifrases')
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
                <div class="panel-heading" style="padding: 5px 15px !important;"><h4><strong>Entre em contato conosco</strong></h4></div>
                <div class="panel-body alert-info">
                    @if(session('result') == 'success')
                        <div class="alert alert-success">
                            <strong>Sucesso!</strong>
                            {{ session("title") }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('result') == 'error')
                        <div class="alert alert-danger">
                            <strong>Erro!</strong>
                            {{ session("title") }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="panel-group">

                        <form class="form-horizontal col-md-12 col-md-offset-1" role="form"
                              action="{{route('principal.enviarcontato')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <label for="nome" class="control-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" title="Nome"
                                               placeholder="Nome"
                                               required="required">

                                    </div>

                                    <div class="col-md-10">
                                        <label for="email" class="control-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" title="E-mail"
                                               placeholder="E-mail"
                                               required="required">
                                    </div>

                                    <div class="col-md-10">
                                        <label for="assunto" class="control-label">Assunto</label>
                                        <input type="text" class="form-control" id="assunto" name="assunto"
                                               title="Assunto" placeholder="Assunto"
                                               required="required">
                                    </div>

                                    <div class="col-md-10">
                                        <label for="mensagem" class="control-label">Mensagem</label>
                                        <textarea class="form-control" rows="8" name="mensagem" id="mensagem"
                                                  title="Mensagem" placeholder="Mensagem"
                                                  required="required"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success" value="Enviar" name="enviar"
                                               title="Enviar"
                                               id="enviar">
                                    </div>
                                </div>
                            </div>
                        </form>
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